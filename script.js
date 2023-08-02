$(document).ready(function() {
  // Register form submission
  $('#registration-form').submit(function(e) {
    e.preventDefault(); // Prevent the form from submitting normally

    // Get form data
    var formData = $(this).serialize();

    // Send registration request to the server
    $.ajax({
      type: 'POST',
      url: 'register_process.php',
      data: formData,
      success: function(response) {
        // Display success message in snackbar
        showSnackbar(response);

        // Redirect to login page after a delay
        setTimeout(function() {
          window.location.href = 'login.php';
        }, 3000); // Delay in milliseconds before redirection
      },
      error: function(xhr, status, error) {
        // Registration failed, display error message in snackbar
        console.log(xhr.responseText);
        showSnackbar('Registration failed. Please try again.');
      }
    });
  });
});

/*
function isvalid(){
  var user = document.form.user.value;
  var pass = document.form.pass.value;
  if(user.length=="" && pass.length==""){
      alert("Username and Password field is empty!!!");
      return false
  }
  else{
      if(user.length==""){
          alert("Username is empty!!!");
          return false
      }
      if(pass.length==""){
          alert("Password is empty!!!");
          return false
      }
  }
}
*/

// Search functionality
document.getElementById('search').addEventListener('input', function() {
  const searchQuery = this.value.trim();

  // Make the AJAX request only if there is a valid search query
  if (searchQuery !== '') {
      // Make the AJAX request to search.php
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `search.php?query=${searchQuery}`, true);
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              const results = JSON.parse(xhr.responseText);
              displaySearchResults(results);
          }
      };
      xhr.send();
  } else {
      // If search query is empty, clear the search results
      displaySearchResults([]);
  }
});

// Function to display the search results
function displaySearchResults(results) {
  const searchResultsContainer = document.getElementById('search-results');
  searchResultsContainer.innerHTML = '';

  results.forEach(result => {
      const listItem = document.createElement('li');
      listItem.textContent = result;
      searchResultsContainer.appendChild(listItem);
  });
}
// Function to handle form submission
function addServiceProvider(event) {
  event.preventDefault();

  // Get form data
  const name = document.getElementById('name').value;
  const email = document.getElementById('email').value;
  const phone = document.getElementById('phone').value;
  const address = document.getElementById('address').value;

  // Make AJAX request to create a new service provider
  const xhr = new XMLHttpRequest();
  xhr.open('POST', 'service_providers.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  xhr.onload = function() {
      if (xhr.status === 200) {
          // Refresh the provider table after adding a new provider
          fetchServiceProviders();
          // Clear the form inputs
          document.getElementById('add-provider-form').reset();
      } else {
          alert('Failed to add service provider.');
      }
  };
  xhr.send(`name=${encodeURIComponent(name)}&email=${encodeURIComponent(email)}&phone=${encodeURIComponent(phone)}&address=${encodeURIComponent(address)}`);
}

// Add event listener to the form for submission
document.getElementById('add-provider-form').addEventListener('submit', addServiceProvider);


// Fetch regions and populate the dropdown
function fetchRegions() {
  axios.get('regions.php')
      .then(response => {
          const regions = response.data;
          const regionDropdown = document.getElementById('region');

          regions.forEach(region => {
              const option = document.createElement('option');
              option.value = region.id;
              option.textContent = region.name;
              regionDropdown.appendChild(option);
          });
      })
      .catch(error => {
          console.error('Error fetching regions:', error);
      });
}

// Call the fetchRegions function to populate the dropdown
fetchRegions();
// Function to delete a service provider
function deleteServiceProvider(id) {
  // Make the AJAX request to delete the service provider
  const xhr = new XMLHttpRequest();
  xhr.open('DELETE', `service_providers.php?id=${id}`, true);
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4) {
          if (xhr.status === 200) {
              // Success: reload the service providers
              fetchServiceProviders();
              alert('Service provider deleted successfully!');
          } else {
              // Error: display the error message
              alert('Failed to delete service provider.');
          }
      }
  };
  xhr.send();
}
// Function to display service providers in the table
function displayServiceProviders(serviceProviders) {
  const tableBody = document.getElementById('service-providers-list');
  tableBody.innerHTML = '';

  serviceProviders.forEach(serviceProvider => {
      const row = document.createElement('tr');
      row.innerHTML = `
          <td>${serviceProvider.name}</td>
          <td>${serviceProvider.email}</td>
          <td>${serviceProvider.phone}</td>
          <td>${serviceProvider.address}</td>
          <td>
              <button onclick="editServiceProvider(${serviceProvider.id})">Edit</button>
              <button onclick="deleteServiceProvider(${serviceProvider.id})">Delete</button>
          </td>
      `;
      tableBody.appendChild(row);
  });
}

// Fetch service providers and display them
function fetchServiceProviders() {
  // Make the AJAX request to service_providers.php
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'service_providers.php', true);
  xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
          const serviceProviders = JSON.parse(xhr.responseText);
          displayServiceProviders(serviceProviders);
      }
  };
  xhr.send();
}

// Call the fetchServiceProviders function to fetch and display the service providers
fetchServiceProviders();


document.addEventListener("DOMContentLoaded", function() {

  $('#search-input').on('input', function() {
      var query = $(this).val();
      searchDatabase(query);
  });

  function searchDatabase(query) {
      $.ajax({
          url: '/search.php',
          type: 'GET',
          data: { query: query },
          dataType: 'json',
          success: function(data) {
              // Display the search results
              displayResults(data);
          },
          error: function(xhr, status, error) {
              console.log("Error: " + error);
          }
      });
  }

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
  function displayResults(results) {
      // Clear previous results
      $('#search-results').empty();

      // Append the results to the search results container
      if (results.length > 0) {
          for (var i = 0; i < results.length; i++) {
              var resultItem = $('<li>').text(results[i]);
              $('#search-results').append(resultItem);
          }
      } else {
          var noResults = $('<li>').text('No results found.');
          $('#search-results').append(noResults);
      }
  }

  //find cemetery in map text scroll
  function scrollToSection() {
    var section = document.querySelector(".regional-map-section");
    section.scrollIntoView({ behavior: "smooth" });
  }
  document.addEventListener("scroll", ()=>{
    const header = document.querySelector("header");

    if(window.scrollY > 0){
      header.classList.add("scrolled");
    }else{
      header.classList.remove("scrolled");
    }
  });
  const navMenu = document.querySelector(".navbar-nav")
  const hamburger = document.querySelector(".hamburger");
  const header = document.querySelector("header");

  hamburger.addEventListener("click", ()=>{
    navMenu.classList.toggle("active");
    hamburger.classList.toggle("active");
    header.classList.toggle("scrolled");
  });
  document.querySelectorAll(".nav-link").forEach(n => n.
  addEventListener("click", ()=>{
    hamburger.classList.remove("active");
    header.classList.remove("scrolled");
  }));
  window.addEventListener("resize", () => {
    navMenu.classList.remove("active"); // Added line to remove "active" class on navMenu when the window is resized
    hamburger.classList.remove("active"); // Added line to remove "active" class on hamburger when the window is resized
  });
})
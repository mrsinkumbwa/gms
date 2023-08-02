document.getElementById("searchQuery").addEventListener("input", function () {
  var searchValue = this.value.trim();

  if (searchValue === "") {
    // If search input is empty, display all options
    var allOptions = []; // Retrieve options from the server or use a preloaded array
    displayResults(allOptions);
  } else {
    // Send AJAX request to the server for filtered options
    $.ajax({
      type: "POST",
      url: "/php/service-providers-page.php", // Update the URL to your server-side script handling the search
      data: {
        search: searchValue,
      },
      success: function (response) {
        var results = JSON.parse(response);
        displayResults(results);
      },
    });
  }
});

function displayResults(results) {
  var searchResults = document.getElementById("searchResults");
  searchResults.innerHTML = ""; // Clear previous results

  if (results.length === 0) {
    // No results found
    searchResults.innerHTML = "<li>No results found.</li>";
  } else {
    // Display the results
    for (var i = 0; i < results.length; i++) {
      var provider = results[i];
      var listItem = document.createElement("li");
      listItem.className = "clickable-list";
      listItem.dataset.info = provider.service_provider_name;

      var nameSpan = document.createElement("span");
      nameSpan.className = "service-providers-name";
      nameSpan.textContent = provider.service_provider_name;

      var totalBurialsSpan = document.createElement("span");
      totalBurialsSpan.className = "total-burials";
      totalBurialsSpan.textContent = provider.total_burials;

      var successfulBurialsSpan = document.createElement("span");
      successfulBurialsSpan.className = "successful-burials";
      successfulBurialsSpan.textContent = provider.successful_burials;

      var unsuccessfulBurialsSpan = document.createElement("span");
      unsuccessfulBurialsSpan.className = "unsuccessful-burials";
      unsuccessfulBurialsSpan.textContent = provider.unsuccessful_burials;

      var successRateSpan = document.createElement("span");
      successRateSpan.className = "success-rate";
      var successRate =
        (provider.successful_burials / provider.total_burials) * 100;
      successRateSpan.textContent = successRate.toFixed(2) + "%";

      listItem.appendChild(nameSpan);
      listItem.appendChild(totalBurialsSpan);
      listItem.appendChild(successfulBurialsSpan);
      listItem.appendChild(unsuccessfulBurialsSpan);
      listItem.appendChild(successRateSpan);

      searchResults.appendChild(listItem);
    }
  }
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
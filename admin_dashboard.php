<!DOCTYPE html>
<html>
<head>
    <title>Superadmin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src=""></script>
    <script>
        $(document).ready(function() {
            // Disable the back functionality
            history.pushState(null, null, location.href);
            window.onpopstate = function () {
                history.go(1);
            };

            $('#search-input').on('input', function() {
                var query = $(this).val();
                searchDatabase(query);
            });

            function searchDatabase(query) {
                $.ajax({
                    url: 'search.php',
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
            
            var backIconContainer = $('<div>').addClass('back-icon-container');
            $('.topnav').append(backIconContainer);
            var currentContent = ''; // Variable to store the current content
            
            var isSideNavHidden = false; // Variable to track side navigation visibility
            
            // Handle side navigation item click
            $('.sidenav a').on('click', function(e) {
                e.preventDefault();
                var href = $(this).attr('href');
                displayContent(href);
            });

            function displayContent(href) {

                // Check the user's role and restrict access if needed
                if (href === 'reviewmoderator_dashboard.php' && <?php echo $_SESSION['role'] === 'superadmin' ? 'false' : 'true'; ?>) {
                    // Redirect to the appropriate page or show an error message
                } else {
                    // Load the content using AJAX
                    // ...
                    // Hide the search results
                    $('#search-results').empty();

                    // Clear the main content section
                    $('#main-content').empty();

                    // Hide the search input
                    $('.search-container').hide();

                    // Clear the back icon container
                    backIconContainer.empty();

                    // Add the back icon
                    var backIcon = $('<i>').addClass('fas fa-arrow-left');
                    backIconContainer.append(backIcon);

                    // Show the back icon container
                    backIconContainer.css('visibility', 'visible');

                    // Toggle the "hidden" class for side navigation, main content, and footer
                    $('.sidenav').toggleClass('hidden');
                    $('main').toggleClass('full-width');
                    $('footer').toggleClass('full-width');

                    // Track side navigation visibility
                    isSideNavHidden = $('.sidenav').hasClass('hidden');
                    // Store the current content
                    currentContent = $('#main-content').html();

                    // Load the content using AJAX
                    $.ajax({
                        url: href + '?ajax=1',
                        type: 'GET',
                        dataType: 'html',
                        success: function(data) {
                            $('#main-content').html(data);
                        },
                        error: function(xhr, status, error) {
                            console.log("Error: " + error);
                        }
                    });

                    // Remove the back icon and show the search input when clicked
                    backIcon.on('click', function() {
                        $('.search-container').show();
                        backIconContainer.empty();
                        backIconContainer.css('visibility', 'hidden'); // Hide the back icon container
                        $('.sidenav').removeClass('hidden', isSideNavHidden);
                        $('main').toggleClass('full-width');
                        $('footer').toggleClass('full-width');
                        $('#main-content').html(currentContent); // Restore the previous content
                    });
                }
                
            }

            // Handle logout item click
            $('#logout').click(function() {
                // Perform logout operation here
                // ...

                // Display the snackbar within the main section
                var snackbar = $('<div>').addClass('snackbar');
                var icon = $('<img>').attr('src', './log-out.svg');
                var text = $('<span>').text('Logout successful');
                snackbar.append(icon, text);
                $('#main-content').append(snackbar);

                // Remove the snackbar after a certain duration
                setTimeout(function() {
                    // Destroy the session and redirect to the login page
                    $.ajax({
                        url: 'logout.php',
                        type: 'POST',
                        success: function(response) {
                            // Clear the session variables in the browser
                            window.location.href = 'login.php';
                        },
                        error: function(xhr, status, error) {
                            console.log("Error: " + error);
                        }
                    });

                    // Redirect to the login page
                    window.location.href = 'login.php';
                }, 3000);
            });


            // Handle topnav item hover
            $('.dropdown-toggle').hover(function() {
                // Hide other topnav items except the logo
                $('.topnav a').not('.logo').not(this).addClass('hidden');

                // Display dropdown for current item
                $(this).find('.dropdown').addClass('visible');
            }, function() {
                // Restore visibility of other topnav items
                $('.topnav a').removeClass('hidden');

                // Hide dropdown for current item
                $(this).find('.dropdown').removeClass('visible');
            });

            // Handle logout item hover separately
            $('#logout').hover(function() {
                // Add additional styling for logout item on hover
                $(this).addClass('logout-hover');
            }, function() {
                // Remove additional styling when cursor moves away from logout item
                $(this).removeClass('logout-hover');
            });

        });
    </script>
    <style>
        /* Add custom styles for the layout */
        @import url('https://fonts.googleapis.com/css2?family=Poppins&family=Rubik+Mono+One&display=swap');
        /* Sticky top header */
        * {
            font-family: 'Poppins';
            font-size: small;
            color: #132;
            font-weight: 600;
            word-spacing: normal;
            letter-spacing: .1em;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #F6E5B2;
            padding: 12px;
            z-index: 1; /* Ensure the header is on top of other elements */
        }

        /* Logo style */
        .logo {
            font-weight: bold;
            font-size: 1.5rem;
            text-decoration: none;
            font-family: 'Rubik Mono One';

        }

        /* Top navigation style */
        .topnav {
            display: flex;
            direction: ltr;
            align-items: center;
            justify-content: space-evenly;
            margin-right: 4%;
        }

        .topnav a {
            padding: 0 1.7em;
            text-decoration: none;
            position: relative;
        }

        /* Hide other topnav items on hover */
        .topnav a.hidden {
            visibility: hidden;
        }

        /* Dropdown style */
        .dropdown {
            position: absolute;
            background-color: #f1E8f0;
            width: 18rem; /* Set the desired width */
            height: 24vh; /* Set the desired height */
            padding: 10px;
            display: none;
            z-index: 2;
            border-radius: .80em .80em .40em .40em;
        }

        .dropdown.visible {
            display: block;
        }

        /* Show dropdown on hover */
        .topnav a:hover .dropdown.visible {
            display: block;
        }

        /* Logout item style */
        #logout {
            position: relative;
            margin-left: 12px;
        }

        /* Add border and background color on hover */
        #logout:hover {
            text-decoration: none;
        }
        /* Create the underline using pseudo-elements */
        #logout:hover::before {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #396;
            transform: scaleX(0); /* Start with no width */
            transform-origin: left; /* Start the animation from the left */
            transition: transform 0.25s ease; /* Add transition for smooth animation */
        }

        /* Extend the underline to the full width on hover */
        #logout:hover::before {
            transform: scaleX(1);
        }
        .snackbar {
            position: fixed;
            left: 45%;
            transform: translateX(-20%);
            background-color: rgba(27, 221, 64, 89.96%);
            font-size: 3rem;
            font-weight: lighter;
            font-family: 'Poppins', sans-serif;
            padding: 20px 30px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        /* CSS for the snackbar text */
        .snackbar span {
            margin-left: 10px;
        }


        /* Side navigation bar */
        .sidenav {
            position: fixed;
            top: 70px; /* Adjust the top position based on your header height */
            left: 0;
            width: 12em;
            height: 100%;
            background-color: #F7F6E1;
            overflow: auto;
            border-top-right-radius: 1em;
            margin-top: 1em;
            transition: width 0.3s ease-in-out; /* Add transition for smooth animation */
        }

        /* Side navigation items */
        .sidenav a {
            display: block;
            margin: 1.5em 1em;
            text-decoration: none;
            color: #333;
            font-family: 'Poppins';
        }

        /* Side navigation item hover effect */
        .sidenav a:hover {
            background-color: #ddd;
            padding: 14px;
            margin: 2px;
            border-radius: 12px;
        }
        .sidenav.hidden {
            width: 0; /* Hide the side navigation by reducing its width to 0 */
            visibility: hidden;
        }
        /* Main content area */
        main {
            margin: 4em 1em 0% 12em; /* Adjust the left margin based on your side navigation width */
            padding: 2em;
            transition: margin 0.3s ease-in-out; /* Add transition for smooth animation */
        }
        main h1 {
            font-family: 'Poppins';
            font-size:2rem;
        }

        main.full-width {
            margin-left: 1em; /* Increase the left margin to occupy the full width when side navigation is hidden */
        }

        /* Search container style */
        .search-container {
            margin-bottom: 20px;
        }

        /* Search input style */
        #search-input {
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }

        /* Search results style */
        #search-results {
            list-style-type: none;
            padding: 2em;
        }

        /* Footer style */
        footer {
            background-color: #F6E5B2;
            padding: 3em;
            border-radius: 1em 1em 0 0 ;
            text-align: start;
            margin-left: 12em;
            transition: margin 0.3s ease-in-out; /* Add transition for smooth animation */
        }
        footer.full-width {
            margin-left: 1em; /* Increase the left margin to occupy the full width when side navigation is hidden */
        }
        .back-icon-container {
            visibility: hidden;
        }
        .back-icon-container i {
        padding: 2em; /* Add padding */
        border-radius: 50%; /* Add border radius */
        transition: all 0.3s ease; /* Add transition for smooth animation */
        }

        .back-icon-container i:hover {
            background-color: #ddd; /* Change the background color on hover */
        }
    </style>
</head>
<body>
<header>
    <div class="topnav">
        <a class="logo" href="#">Heavenly Tombs</a>
        <nav>
            <a href="#" class="dropdown-toggle">Messages
                <div class="dropdown">
                    <!-- Dropdown content for Messages -->
                    <!-- Add your content here -->
                </div>
            </a>
            <a href="#" class="dropdown-toggle">Notifications
                <div class="dropdown">
                    <!-- Dropdown content for Notifications -->
                    <!-- Add your content here -->
                </div>
            </a>
            <a href="#" class="dropdown-toggle">Settings
                <div class="dropdown">
                    <!-- Dropdown content for Settings -->
                    <!-- Add your content here -->
                </div>
            </a>
            <a href="#" id="logout">Logout</a>
        </nav>
    </div>
</header>
    <nav class="sidenav">
        <a href="service_providers.php" target="_self">Service Providers</a>
        <a href="graveyards.php" target="_self">Graveyards</a>
        <a href="graves.php" target="_self">Graves</a>
        <a href="reviews.php" target="_self">Reviews</a>
    </nav>

    <main>
        <h1>ADMINISTRATOR DASHBOARD</h1>
        
        <div class="search-container">
            <input type="text" id="search-input" placeholder="Search the database...">
        </div>

        <ul id="search-results"></ul>

        <div id="main-content"></div>
    </main>

    <footer>
        <p>
            This is the footer content.
        </p>
    </footer>
</body>
</html>
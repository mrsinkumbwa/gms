<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">

  <!-- Add this link to include Font Awesome icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Add your other meta tags, title, and other CSS/JS links here -->
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Graveyard Management System</title>

  <!-- Add your CSS styles here -->
  <link rel="stylesheet" href="http://localhost/gms/serviceProviderFacingView/css/index.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;900&family=Rubik+Mono+One&display=swap" rel="stylesheet">

</head>
<body>
<header>
    <div class="logo">
      <img src="path_to_your_logo_image.png" alt="Heavenly Tomb Logo">
      <h1>Heavenly Tombs</h1>
    </div>
    <!-- Move the main-nav outside the hamburger div -->
    <nav class="main-nav" id="main-nav">
      <ul>
        <li><a href="#features">Features</a></li>
        <li><a href="#pricing">Pricing</a></li>
        <li><a href="#about">About Us</a></li>
        <li><a href="#contact">Contact Us</a></li>
      </ul>
    </nav>

    <!-- Add the hamburger icon (e.g., ☰) for smaller screens -->
    <div class="hamburger">
      <span></span>
      <span></span>
      <span></span>
    </div>

    <!-- The close icon (X icon) for the expanded navigation menu -->
    <div class="close-icon">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </header>

  <main>
    <!-- Service Provider Banner -->
    <div class="service-provider-banner" id="animated-banner">
    </div>
    <div class="animation" id="animated-text">
      </div>
    <section class="main-section" >
      <div class="login-form" id="login">
        <h2>Login</h2>
        <form action="login.php" method="post">
          <input type="text" name="username_email" placeholder="Username or Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit">Login</button>
        </form>
        <p id="register-link-paragraph">Don't have an account? <a href="#pricing" id="register-link">Choose a plan and register</a>.</p>
        <!-- New paragraph for registration link -->
        <p id="register-here-paragraph" style="display: none;">Don't have an account? <a href="#register" id="register-here-link">Register here</a>.</p>
      </div>
    </section>

    <section id="features">
      <h2>Features</h2>
      <p>Our Graveyard Management System offers a comprehensive set of features tailored to meet the unique needs of service providers in Namibia:</p>
      <ul>
        <li>Service Bookings Notifications: Receive real-time notifications for new service booking requests from customers.</li>
        <li>Booking Display: View a detailed display of service booking requests, including customer information and graveyard details.</li>
        <li>Easy Request Management: Approve or decline service booking requests based on your availability and preferences.</li>
        <li>Efficient Customer Communication: Communicate directly with customers who have booked your services for a personalized experience.</li>
        <li>Advertisement Opportunities: Promote your services to a targeted audience by showcasing your offerings on our platform.</li>
        <li>Service Provider Listings: Create and manage your service provider account with a customizable profile.</li>
        <li>Payment Processing: Receive secure and timely payments for your services through multiple payment gateways.</li>
        <li>Review and Rating System: Access and respond to customer reviews to build trust and reputation.</li>
        <li>Private Messaging: Interact with customers through private messages for personalized communication.</li>
        <li>Insightful Analytics: Access valuable data and insights into your service bookings and customer interactions.</li>
        <li>Easy Account Management: User-friendly interface for updating your service offerings, availability, and preferences.</li>
      </ul>
    </section>

    <section id="pricing">
      <h2>Pricing</h2>
      <p>As a service provider, you can choose the subscription plan that suits your needs:</p>

      <div class="table-container">
        <table>
          <thead>
            <tr>
              <th>Subscription Model</th>
              <th>Price (N$)</th>
              <th>Exclusive Features</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Monthly</td>
              <td>N$X</td>
              <td>
                <ul>
                  <li>Real-time Service Booking Notifications</li>
                  <li>Detailed Booking Display</li>
                  <li>Direct Customer Communication</li>
                  <li>Access & Respond to Reviews and Ratings</li>
                  <li>Showcase Offerings in Advertisements</li>
                  <li>Limited (10) Service Provider Listings</li>
                  <li>Secure Payment Processing</li>
                  <li>Standard Email Support</li>
                </ul>
              </td>
              <td>
                <button id="monthly_option" onclick="selectSubscription('Monthly', 'N$X', '-')">CHOOSE</button>
              </td>
            </tr>
            <tr>
              <td>Annual</td>
              <td>N$Y</td>
              <td>
                <ul>
                  <li>Real-time Service Booking Notifications</li>
                  <li>Detailed Booking Display</li>
                  <li>Direct Customer Communication</li>
                  <li>Access & Respond to Reviews and Ratings</li>
                  <li>Access & Respond to Private Messages</li>
                  <li>Showcase Offerings in Advertisements</li>
                  <li>Unlimited Service Provider Listings</li>
                  <li>Secure Payment Processing</li>
                  <li>Priority Email & Phone Support</li>
                </ul>
              </td>
              <td>
                <button id="annual_option" onclick="selectSubscription('Annual', 'N$Y', '-')">CHOOSE</button>
              </td>
            </tr>
            <tr>
              <td>Free (First 3 Months)</td>
              <td>Free</td>
              <td>
                <ul>
                  <li>Real-time Service Booking Notifications</li>
                  <li>Detailed Booking Display</li>
                  <li>Direct Customer Communication</li>
                  <li>Access & Respond to Reviews and Ratings</li>
                  <li>Showcase Offerings in Advertisements</li>
                  <li>Limited (5) Service Provider Listings</li>
                  <li>Secure Payment Processing</li>
                  <li>Basic Email Support</li>
                </ul>
              </td>
              <td>
                <button id="free_option" onclick="selectSubscription('Free (First 3 Months)', 'Free', '-')">CHOOSE</button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>


      <div class="register-form" id="register">
        <h2>Register</h2>
        <p>You have selected the subscription model: <span id="selected_subscription_model"></span></p>
        <form action="./process_registration.php" method="post" enctype="multipart/form-data">
          <!-- Add a hidden input field to store the selected subscription model -->
          <input type="hidden" id="subscription_model" name="subscription_model">

          <input type="text" name="username" placeholder="Username" required>
          <input type="text" name="email" placeholder="Email" required>
          <input type="password" name="password" placeholder="Password" required>
          <input type="text" name="business_name" placeholder="Business Name" required>
          <label for="region">Region:</label>
          <select name="region" id="region" required>
            <option value="">Select Region</option>
            <option value="Caprivi">Caprivi</option>
            <option value="Erongo">Erongo</option>
            <option value="Hardap">Hardap</option>
            <option value="Kavango East">Kavango East</option>
            <option value="Kavango West">Kavango West</option>
            <option value="Khomas">Khomas</option>
            <option value="Kunene">Kunene</option>
            <option value="Ohangwena">Ohangwena</option>
            <option value="Omaheke">Omaheke</option>
            <option value="Omusati">Omusati</option>
            <option value="Oshana">Oshana</option>
            <option value="Oshikoto">Oshikoto</option>
            <option value="Otjozondjupa">Otjozondjupa</option>
            <option value="Zambezi">Zambezi</option>
          </select>

          <input type="text" name="business_address" placeholder="Business Address" required>
          
          <textarea id="bio" name="bio" placeholder="Enter your bio here (100 words max)" maxlength="500" oninput="countCharacters()" required></textarea>
          <div class="alert" id="bio-alert" style="display: none;">Maximum number of characters reached!</div>
          <p>Remaining Characters: <span id="char-count"></span></p>
          <p>Word Count: <span id="word-count"></span></p>
          <!-- New input field for services -->
          <label for="services">Services Provided (separated by commas):</label>
          <input type="text" name="services" id="services" placeholder="e.g., Service 1, Service 2, Service 3" required>

          <button type="submit">Register</button>
        </form>
        <p>Already have an account? <a href="#login" id="login-link">Login here</a></p>
      </div>
    </section>
  

  <!-- About Us section -->
  <section id="about">
    <h2>About Us</h2>
    <p>We are a dedicated team passionate about revolutionizing graveyard bookings and services in Namibia. Our mission is to create an innovative and user-friendly Graveyard Management System that caters to the specific needs of our users.</p>
    <p>If you have any questions or need assistance, feel free to reach out to us through the following contact channels:</p>
    <ul>
      <li>Help Lines: +264 123 4567</li>
      <li>General Queries: info@heavenlytomb.com</li>
      <li>Technical Support: support@heavenlytomb.com</li>
      <li>Advertising Inquiries: ads@heavenlytomb.com</li>
    </ul>
  </section>

  <!-- Contact Us section -->
  <section id="contact">
    <h2>Contact Us</h2>
    <p>If you are a service provider and have specific queries or require assistance, please use the form below to get in touch with us:</p>
    <form action="submit_query.php" method="post">
      <label for="query_title">Query Title:</label>
      <input type="text" name="query_title" id="query_title" required>

      <label for="query_message">Message:</label>
      <textarea name="query_message" id="query_message" rows="6" placeholder="Enter your message here" required></textarea>

      <button type="submit">Submit Query</button>
    </form>
  </section>
</main>
<footer>
  <div>
    <h3>Organization</h3>
    <ul>
      <li><a href="#about">About Us</a></li>
      <li><a href="#contact">Contact Us</a></li>
      <li><a href="#features">Features</a></li>
    </ul>
  </div>

  <div>
    <h3>Government Policies</h3>
    <ul>
      <li><a href="#">Graveyard Regulations</a></li>
      <li><a href="#">Environmental Guidelines</a></li>
    </ul>
  </div>

  <div>
    <h3>Licenses</h3>
    <ul>
      <li><a href="#">License Information</a></li>
    </ul>
  </div>

  <div>
    <h3>Developer Section</h3>
    <ul>
      <li><a href="#">API Documentation</a></li>
      <li><a href="#">Developer Resources</a></li>
    </ul>
  </div>

  <div>
    <h3>Education</h3>
    <ul>
      <li><a href="#">Graveyard Management Guide</a></li>
      <li><a href="#">Tombstone Maintenance Tips</a></li>
    </ul>
  </div>

  <div>
    <h3>Request a Live Demo</h3>
    <p>Contact us to request a live demonstration of our Graveyard Management System.</p>
    <a href="#contact">Request Demo</a>
  </div>

  <p>&copy; <?php echo date('Y'); ?> Heavenly Tomb. All rights reserved.</p>
</footer>
<script src="http://localhost/gms/serviceProviderFacingView/js/index.js"></script>
<!-- Add your JavaScript files here -->
<script src="http://localhost/gms/serviceProviderFacingView/js/register.js"></script>
</body>
</html>

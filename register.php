<!-- register.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Heavenly Tombs - User Registration</title>
  <link rel="stylesheet" type="text/css" href="registerStyle.css">
</head>
<body>
  <header>
    <div class="logo">
      <h1 id="logoName">HEAVENLY TOMBS</h1>
    </div>

    <nav class="topNav">
      <ul>
        <li><a href="">FEATURES</a></li>
        <li><a href="">ABOUT</a></li>
        <li><a href="">PRICING</a></li>
        <li><a href="login.php">LOGIN</a></li>
      </ul>
    </nav>
  </header>
  <div class="container">
    <h2 id="header">User Registration</h2>
    <form method="POST" id="registration-form" action="register_process.php">
      <div class="form-group">
        <label for="first_name">First Name:</label>
        <input type="text" name="first_name" id="first_name" required>
      </div>
      <div class="form-group">
        <label for="last_name">Last Name:</label>
        <input type="text" name="last_name" id="last_name" required>
      </div>
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
      </div>
      <div class="form-group">
        <label for="confirm_password">Confirm Password:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
      </div>
      <button id="registerButton" type="submit" name="register">Register</button>
    </form>
  </div>

  <!-- Snackbar -->
  <div id="snackbar"></div>
  
  <script src="script.js"></script>
</body>
</html>

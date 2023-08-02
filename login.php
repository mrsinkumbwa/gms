<!-- login.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Heavenly Tombs - User Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="container">
    <h2>User Login</h2>
    <form method="POST" id="login-form" action="login_process.php">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
      </div>
      <button type="submit" name="login">Login</button>
    </form>
    <p><a href="forgot_password.php">Forgot Password?</a></p>
    <p><a href="adminLogin.php">Admin Login</a></p>
  </div>
  <script src="script.js"></script>
</body>
</html>

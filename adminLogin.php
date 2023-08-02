<!-- adminlogin.php -->
<!DOCTYPE html>
<html>
<head>
  <title>Heavenly Tombs - Admin Login</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Admin Login</h2>
        <form method="POST" id="admin-login-form" action="login_process.php">
            <div class="form-group">
                <label for="admin_username">Username:</label>
                <input type="text" name="admin_username" id="admin_username" required>
            </div>
            <div class="form-group">
                <label for="admin_password">Password:</label>
                <input type="password" name="admin_password" id="admin_password" required>
            </div>
            <button type="submit" name="admin_login" id="admin-login-button">Login</button>
        </form>
    </div>

    <script src="script.js"></script>
</body>
</html>

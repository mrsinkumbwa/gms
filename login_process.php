<?php
require_once('users.php');
require_once('admins.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['login'])) {
        // User login
        $email = $_POST['email'];
        $password = $_POST['password'];

        $users = new Users();
        $user = $users->authenticateUser($email, $password);

        if ($user) {
            // User authentication successful
            // Redirect to user dashboard or any desired page
            header("Location: user_dashboard.php");
            exit();
        } else {
            // User authentication failed
            // Display error message or redirect to login page with error
            header("Location: login.php?error=1");
            exit();
        }
    } elseif (isset($_POST['admin_login'])) {
        // Admin login
        $admin_username = $_POST['admin_username'];
        $admin_password = $_POST['admin_password'];

        $admins = new Admins();
        $admin = $admins->authenticateAdmin($admin_username, $admin_password);

        if ($admin) {
            // Admin authentication successful
            if ($admin['role'] == 'superadmin') {
                // Redirect to superadmin dashboard
                header("Location: superadmin_dashboard.php");
                exit();
            } elseif ($admin['role'] == 'reviewmoderator') {
                // Redirect to review moderator dashboard
                header("Location: reviewmoderator_dashboard.php");
                exit();
            }
        } else {
            // Admin authentication failed
            // Display error message or redirect to login page with error
            header("Location: adminlogin.php?error=1");
            exit();
        }
    } else {
        // Invalid login request
        header("Location: login.php");
        exit();
    }
} else {
    // If the request method is not POST, return an error response
    $response = array("message" => "Invalid request method");
    http_response_code(405);
    echo json_encode($response);
}
?>

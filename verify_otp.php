<?php
session_start();

// Check if the OTP and registration data are stored in the session
if (isset($_SESSION['otp']) && isset($_SESSION['registration_data'])) {
    $otp = $_SESSION['otp'];
    $registrationData = $_SESSION['registration_data'];

    // Check if the request method is POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the entered OTP
        $enteredOTP = $_POST['otp'];

        // Check if the entered OTP matches the stored OTP
        if ($enteredOTP == $otp) {
            // OTP verification successful
            // Clear the OTP and registration data from the session
            unset($_SESSION['otp']);
            unset($_SESSION['registration_data']);

            // Store the user's data in the database
            require_once('users.php');
            $users = new Users();
            $result = $users->createUser($registrationData);

            if ($result) {
                // Registration successful
                $response = array("message" => "User registered successfully");
                http_response_code(200);

                // Redirect to login page after 3 seconds
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'login.php';
                    }, 3000);
                </script>";
            } else {
                // Registration failed
                $response = array("message" => "User registration failed");
                http_response_code(500);

                // Display the response in a custom modal
                echo "<script>
                    alert('User registration failed');
                </script>";
            }
        } else {
            // OTP verification failed
            $response = array("message" => "Invalid OTP");
            http_response_code(400);

            // Display the response in a custom modal
            echo "<script>
                alert('Invalid OTP');
            </script>";
        }
    } else {
        // If the request method is not POST, return an error response
        $response = array("message" => "Invalid request method");
        http_response_code(405);
        echo json_encode($response);
    }
} else {
    // OTP and registration data not found in the session
    header("Location: register.php");
    exit();
}
?>

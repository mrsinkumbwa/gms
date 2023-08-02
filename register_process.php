<?php
require_once('users.php');

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the POST data
    $data = array(
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'email' => $_POST['email'],
        'phone' => $_POST['phone'],
        'password' => $_POST['password']
    );

    // Create a new instance of the Users class
    $users = new Users();

    // Check if email already exists
    if ($users->emailExists($data['email'])) {
        // Email already exists
        $response = array("message" => "An account with this email already exists");
        http_response_code(409);

        // Display the response in a custom modal
        echo "<script>
            alert('An account with this email already exists');
        </script>";
    } else {
        // Check if password matches confirm password
        if ($_POST['password'] !== $_POST['confirm_password']) {
            // Password does not match
            $response = array("message" => "Password and Confirm Password do not match");
            http_response_code(400);

            // Display the response in a custom modal
            echo "<script>
                alert('Password and Confirm Password do not match');
            </script>";
        } else {
            // Create the user
            $result = $users->createUser($data);

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
        }
    }

    echo json_encode($response);
} else {
    // If the request method is not POST, return an error response
    $response = array("message" => "Invalid request method");
    http_response_code(405);
    echo json_encode($response);
}
?>

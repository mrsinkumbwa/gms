<?php
    // Include any necessary configurations and database connections here
    // ...

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $business_name = $_POST['business_name'];
        $business_address = $_POST['business_address'];
        $bio = $_POST['bio'];

        // Validate and sanitize inputs (you should implement proper validation here)

        // Process uploaded profile picture
        $profile_picture = null;
        if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
            // Specify the directory to store the uploaded images
            $target_directory = 'uploads/';
            // Generate a unique filename for the uploaded image
            $profile_picture = $target_directory . uniqid('profile_', true) . '_' . $_FILES['profile_picture']['name'];
            // Move the uploaded image to the target directory
            move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
        }

        // Process uploaded cover photo
        $cover_photo = null;
        if (isset($_FILES['cover_photo']) && $_FILES['cover_photo']['error'] === UPLOAD_ERR_OK) {
            // Specify the directory to store the uploaded images
            $target_directory = 'uploads/';
            // Generate a unique filename for the uploaded image
            $cover_photo = $target_directory . uniqid('cover_', true) . '_' . $_FILES['cover_photo']['name'];
            // Move the uploaded image to the target directory
            move_uploaded_file($_FILES['cover_photo']['tmp_name'], $cover_photo);
        }

        // Insert user information into the database
        // Perform appropriate database queries to insert the data into the 'service_providers' table
        // (you should use prepared statements to prevent SQL injection)

        // Example code using MySQLi (you can adjust this based on your database connection)
        $mysqli = new mysqli('localhost', 'username', 'password', 'database_name');
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        // Prepare and execute the insert query
        $query = "INSERT INTO service_providers (user_id, business_name, business_address, profile_picture, cover_photo, bio)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $mysqli->prepare($query);
        // You should have a user_id associated with the service provider (if applicable)
        // For this example, let's assume the user_id is 1 (you need to adjust this based on your system)
        $user_id = 1;
        $stmt->bind_param("isssss", $user_id, $business_name, $business_address, $profile_picture, $cover_photo, $bio);
        $stmt->execute();
        $stmt->close();

        // Close the database connection
        $mysqli->close();

        // Redirect to the login page after successful registration
        header("Location: login.php");
        exit();
    }
?>
<?php
// Include the database configuration file
include_once "http://localhost/gms/database.php";

// Function to upload an image file and return the uploaded file path
function uploadImage($file, $targetDirectory)
{
    $fileName = basename($file["name"]);
    $targetFilePath = $targetDirectory . $fileName;
    $imageFileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Check if the file is an actual image or a fake image
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        return false; // Not a valid image
    }

    // Check if the file already exists
    if (file_exists($targetFilePath)) {
        return false; // File already exists
    }

    // Check file size (limit it to 2MB)
    if ($file["size"] > 2 * 1024 * 1024) {
        return false; // File too large
    }

    // Allow only certain image file formats
    $allowedExtensions = array("jpg", "jpeg", "png", "gif");
    if (!in_array($imageFileType, $allowedExtensions)) {
        return false; // Invalid file type
    }

    // Upload the file
    if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
        return $targetFilePath; // File uploaded successfully
    } else {
        return false; // Failed to upload the file
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $subscriptionModel = $_POST["subscription_model"];
    $bio = $_POST["bio"];
    $services = $_POST["services"];

    // Prepare and execute the SQL query to insert the user data into the database
    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username, $email, $password, "service_provider"]);

    // Get the ID of the newly inserted user
    $userId = $conn->lastInsertId();

    // Upload profile picture
    if (!empty($_FILES["profile_picture"]["name"])) {
        $profilePicturePath = uploadImage($_FILES["profile_picture"], "profile_pictures/");
        if ($profilePicturePath) {
            // Save the profile picture URL to the database
            $sql = "UPDATE service_providers SET profile_picture_url = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$profilePicturePath, $userId]);
        }
    }

    // Upload cover photo
    if (!empty($_FILES["cover_photo"]["name"])) {
        $coverPhotoPath = uploadImage($_FILES["cover_photo"], "cover_photos/");
        if ($coverPhotoPath) {
            // Save the cover photo URL to the database
            $sql = "UPDATE service_providers SET cover_photo_url = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$coverPhotoPath, $userId]);
        }
    }

    // Insert data into the service_providers table
    $sql = "INSERT INTO service_providers (user_id, subscription_model, bio) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$userId, $subscriptionModel, $bio]);

    // Insert services into the service_provider_services table
    $servicesArray = explode(", ", $services);
    foreach ($servicesArray as $service) {
        $sql = "INSERT INTO service_provider_services (service_provider_id, service_name) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$userId, $service]);
    }

    // Redirect the user to the dashboard homepage after successful registration
    header("Location: dashboard.php");
    exit();
}
?>

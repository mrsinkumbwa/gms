// File: register_service_provider.php
// Description: Handle service provider registration

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Include the database configuration file
    require_once('db_config.php');

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $businessName = $_POST['business_name'];
    $region = $_POST['region'];
    $businessAddress = $_POST['business_address'];
    $bio = $_POST['bio'];
    $services = $_POST['services'];

    // Validate input data (e.g., check if username/email is unique)

    // Hash the password before storing in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Execute the stored procedure to register the service provider
    $stmt = $pdo->prepare("CALL register_service_provider(:username, :email, :password, :business_name, :region, :business_address, :bio, :services)");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->bindParam(':business_name', $businessName);
    $stmt->bindParam(':region', $region);
    $stmt->bindParam(':business_address', $businessAddress);
    $stmt->bindParam(':bio', $bio);
    $stmt->bindParam(':services', $services);
    $stmt->execute();

    // Check the result and handle success or failure accordingly
    // For example, redirect the user to the appropriate page after successful registration
    // You can use header() function to redirect
    header("Location: service_provider_dashboard.php");
    exit();
}

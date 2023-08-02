<?php
// Include the database.php file
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data and sanitize it
    $selectedRegionId = filter_input(INPUT_POST, "selected_region", FILTER_SANITIZE_NUMBER_INT);
    $service_provider_name = filter_input(INPUT_POST, "service_provider_name", FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
    $address = filter_input(INPUT_POST, "address", FILTER_SANITIZE_STRING);
    $service_name = filter_input(INPUT_POST, "service_name", FILTER_SANITIZE_STRING);

    // Validate the data
    if (empty($selectedRegionId) || empty($service_provider_name) || empty($email) || empty($phone) || empty($address) || empty($service_name)) {
        http_response_code(400); // Bad Request
        echo "All fields are required.";
        exit;
    }

    // Create a new instance of the Database class
    $database = new Database();

    // Get the database connection
    $conn = $database->getConnection();

    // Insert data into Service Providers table
    $sqlServiceProvider = "INSERT INTO service_providers (service_provider_name, email, phone, address, region_id) VALUES (?, ?, ?, ?, ?)";
    $stmtServiceProvider = $conn->prepare($sqlServiceProvider);
    $stmtServiceProvider->bind_param("ssssi", $service_provider_name, $email, $phone, $address, $selectedRegionId);

    if (!$stmtServiceProvider->execute()) {
        http_response_code(500); // Internal Server Error
        echo "Error inserting data into Service Providers table: " . $stmtServiceProvider->error;
        exit;
    }

    // Insert data into Service Provider Services table
    $sqlServiceProviderServices = "INSERT INTO service_provider_services (service_name, service_provider_name) VALUES (?, ?)";
    $stmtServiceProviderServices = $conn->prepare($sqlServiceProviderServices);
    $stmtServiceProviderServices->bind_param("ss", $service_name, $service_provider_name);

    if (!$stmtServiceProviderServices->execute()) {
        http_response_code(500); // Internal Server Error
        echo "Error inserting data into Service Provider Services table: " . $stmtServiceProviderServices->error;
        exit;
    }

    // Close the database connection
    $database->closeConnection();

    // Return success response
    http_response_code(200); // OK
    echo "Data successfully inserted into the database.";
} else {
    // Handle the case where no data is submitted (optional)
    http_response_code(400); // Bad Request
    echo "No data submitted.";
}
?>

<?php
// Include the database.php file
include 'database.php';

// Create a new instance of the Database class
$database = new Database();

// Get the database connection
$conn = $database->getConnection();

// Variables to hold the form data
$selectedRegionId = $_POST["selected_region"];
$service_provider_name = $_POST["service_provider_name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$address = $_POST["address"];
$service_name = $_POST["service_name"];

// Insert data into Service Providers table
$sqlServiceProvider = "INSERT INTO service_providers (service_provider_name, email, phone, address, region_id) VALUES (?, ?, ?, ?, ?)";
$stmtServiceProvider = $conn->prepare($sqlServiceProvider);
$stmtServiceProvider->bind_param("ssssi", $service_provider_name, $email, $phone, $address, $selectedRegionId);
$stmtServiceProvider->execute();

// Insert data into Service Provider Services table
$sqlServiceProviderServices = "INSERT INTO service_provider_services (service_name, service_provider_name) VALUES (?, ?)";
$stmtServiceProviderServices = $conn->prepare($sqlServiceProviderServices);
$stmtServiceProviderServices->bind_param("ss", $service_name, $service_provider_name);
$stmtServiceProviderServices->execute();

// Close the database connection
$database->closeConnection();

// Return a JSON response indicating success
$response = array("status" => "success", "message" => "Data successfully inserted into the database.");
echo json_encode($response);
?>

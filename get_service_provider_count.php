<?php
// Include the database.php file
include 'database.php';

// Create a new instance of the Database class
$database = new Database();

// Get the database connection
$conn = $database->getConnection();

// Query to get the count of service providers
$sqlCount = "SELECT COUNT(*) AS providerCount FROM service_providers";
$resultCount = $conn->query($sqlCount);
$countRow = $resultCount->fetch_assoc();
$providerCount = $countRow['providerCount'];

// Close the database connection
$database->closeConnection();

// Return the count in JSON format
header('Content-Type: application/json');
echo json_encode(['count' => $providerCount]);
?>

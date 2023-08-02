<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heavenly_tomb";

// Create a new connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch funeral service providers from the database
$sql = "SELECT service_provider_name FROM service_providers";
$result = $conn->query($sql);

$providers = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $providers[] = $row;
    }
}

// Return the providers as JSON
header('Content-Type: application/json');
echo json_encode($providers);

// Close the database connection
$conn->close();
?>
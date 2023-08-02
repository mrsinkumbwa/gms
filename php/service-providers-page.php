<?php
// Create a connection to your MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heavenly_tomb";


// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve search query value
$searchValue = $_POST["search"];

// Check if search query is empty
if (empty($searchValue)) {
    // Fetch all options from the database
    $sql = "SELECT * FROM service_providers";
} else {
    // Construct the SQL query to filter options based on the search query
    $sql = "SELECT * FROM service_providers WHERE service_provider_name LIKE '%$searchValue%'";
}

// Execute the SQL query
$result = $conn->query($sql);

// Prepare the results as an array
$resultsArray = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $resultsArray[] = $row;
    }
}
// Return the results as JSON
echo json_encode($resultsArray);

$conn->close();
?>
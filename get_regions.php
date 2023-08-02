<?php
// Include the database connection file
require_once 'database.php';

// Function to fetch all regions from the database
function getAllRegions()
{
    global $conn;
    $sql = "SELECT * FROM regions";
    $result = $conn->query($sql);
    $regions = [];
    while ($row = $result->fetch_assoc()) {
        $regions[] = $row;
    }
    return $regions;
}

// Fetch all regions
$regions = getAllRegions();

// Return the regions data in JSON format
header('Content-Type: application/json');
echo json_encode($regions);
?>

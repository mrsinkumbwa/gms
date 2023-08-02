<?php

// Include the connection file
require_once 'database.php';

// Function to fetch all regions
function getAllRegions()
{
    global $conn;
    $sql = "SELECT * FROM regions";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $regions = [];
        while ($row = $result->fetch_assoc()) {
            $regions[] = $row;
        }
        return $regions;
    } else {
        return [];
    }
}

// API endpoint to fetch all regions
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $regions = getAllRegions();
    header('Content-Type: application/json');
    echo json_encode($regions);
    exit;
}

// Function to create a new region
function createRegion($regionName)
{
    global $conn;
    $regionName = $conn->real_escape_string($regionName);

    $sql = "INSERT INTO regions (regionName) VALUES ('$regionName')";
    if ($conn->query($sql) === true) {
        return true;
    } else {
        return false;
    }
}

// Function to update a region
function updateRegion($regionId, $regionName)
{
    global $conn;
    $regionName = $conn->real_escape_string($regionName);

    $sql = "UPDATE regions SET regionName = '$regionName' WHERE regionId = $regionId";
    if ($conn->query($sql) === true) {
        return true;
    } else {
        return false;
    }
}

// Function to delete a region
function deleteRegion($regionId)
{
    global $conn;
    $sql = "DELETE FROM regions WHERE regionId = $regionId";
    if ($conn->query($sql) === true) {
        return true;
    } else {
        return false;
    }
}
?>

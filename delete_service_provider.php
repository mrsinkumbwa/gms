<?php
// Include the database.php file
include 'database.php';

// Create a new instance of the Database class
$database = new Database();

// Get the database connection
$conn = $database->getConnection();

// Check if the HTTP POST request is made with the service_provider_name parameter
if (isset($_POST['service_provider_name'])) {
    // Retrieve the service provider name from the POST data
    $service_provider_name = $_POST['service_provider_name'];

    // Initialize a flag to track the success of deletions
    $deletionSuccess = true;

    // Start a transaction to ensure atomicity
    $conn->begin_transaction();

    try {
        // Prepare the SQL statement to delete service_provider_services records
        $sqlDeleteServiceProviderServices = "DELETE FROM service_provider_services WHERE service_provider_name = ?";
        $stmtDeleteServiceProviderServices = $conn->prepare($sqlDeleteServiceProviderServices);
        $stmtDeleteServiceProviderServices->bind_param("s", $service_provider_name);

        // Execute the delete query for service_provider_services
        if (!$stmtDeleteServiceProviderServices->execute()) {
            $deletionSuccess = false;
        }

        // Prepare the SQL statement to delete service_providers records
        $sqlDeleteServiceProvider = "DELETE FROM service_providers WHERE service_provider_name = ?";
        $stmtDeleteServiceProvider = $conn->prepare($sqlDeleteServiceProvider);
        $stmtDeleteServiceProvider->bind_param("s", $service_provider_name);

        // Execute the delete query for service_providers
        if (!$stmtDeleteServiceProvider->execute()) {
            $deletionSuccess = false;
        }

        // Prepare the SQL statement to delete regions records
        $sqlDeleteRegion = "DELETE FROM regions WHERE regionId = ?";
        $stmtDeleteRegion = $conn->prepare($sqlDeleteRegion);
        $stmtDeleteRegion->bind_param("i", $service_provider_name);

        // Execute the delete query for regions
        if (!$stmtDeleteRegion->execute()) {
            $deletionSuccess = false;
        }

        // Check if all deletions were successful
        if ($deletionSuccess) {
            // Commit the transaction if all queries were successful
            $conn->commit();

            // Return a JSON response indicating successful deletion
            echo json_encode(array('status' => 'success'));
        } else {
            // Rollback the transaction if any query failed
            $conn->rollback();

            // Return a JSON response indicating error if any deletion fails
            echo json_encode(array('status' => 'error', 'message' => 'Error deleting service provider and related data.'));
        }
    } catch (Exception $e) {
        // Rollback the transaction if an exception is caught
        $conn->rollback();

        // Return a JSON response indicating error in case of an exception
        echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $e->getMessage()));
    }
} else {
    // Return a JSON response indicating error if service_provider_name parameter is not provided
    echo json_encode(array('status' => 'error', 'message' => 'Service provider name not provided in the request.'));
}

// Close the database connection
$database->closeConnection();
?>

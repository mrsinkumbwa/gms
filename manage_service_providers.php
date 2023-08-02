<?php
    // Include the connection file
    require_once 'database.php';

    // Function to create a new service provider
    function createServiceProvider($service_provider_name, $email, $phone, $address, $region_id)
    {
        global $conn;
        $service_provider_name = $conn->real_escape_string($service_provider_name);
        $email = $conn->real_escape_string($email);
        $phone = $conn->real_escape_string($phone);
        $address = $conn->real_escape_string($address);
        $region_id = $conn->real_escape_string($region_id);

        $sql = "INSERT INTO service_providers (service_provider_name, email, phone, address, region_id) VALUES ('$service_provider_name', '$email', '$phone', '$address', '$region_id')";
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    // Function to update a service provider
    function updateServiceProvider($service_provider_name, $email, $phone, $address, $region_id)
    {
        global $conn;
        $service_provider_name = $conn->real_escape_string($service_provider_name);
        $email = $conn->real_escape_string($email);
        $phone = $conn->real_escape_string($phone);
        $address = $conn->real_escape_string($address);
        $region_id = $conn->real_escape_string($region_id);

        $sql = "UPDATE service_providers SET email = '$email', phone = '$phone', address = '$address', region_id = '$region_id' WHERE service_provider_name = '$service_provider_name'";
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    // Function to delete a service provider
    function deleteServiceProvider($service_provider_name)
    {
        global $conn;
        $service_provider_name = $conn->real_escape_string($service_provider_name);

        $sql = "DELETE FROM service_providers WHERE service_provider_name = '$service_provider_name'";
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

    function getAllServiceProviders()
    {
        global $conn;
        $sql = "SELECT * FROM service_providers";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $serviceProviders = [];
            while ($row = $result->fetch_assoc()) {
                $serviceProviders[] = $row;
            }
            return $serviceProviders;
        } else {
            return [];
        }
    }

    // Function to fetch all services offered by a service provider
    function getServicesByServiceProvider($service_provider_name)
    {
        global $conn;
        $service_provider_name = $conn->real_escape_string($service_provider_name);
        $sql = "SELECT service_name FROM service_provider_services WHERE service_provider_name = '$service_provider_name'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $services = [];
            while ($row = $result->fetch_assoc()) {
                $services[] = $row['service_name'];
            }
            return $services;
        } else {
            return [];
        }
    }
    function createServiceProviderService($service_name, $service_provider_name)
        {
            global $conn;
            $service_name = $conn->real_escape_string($service_name);
            $service_provider_name = $conn->real_escape_string($service_provider_name);

            $sql = "INSERT INTO service_provider_services (service_name, service_provider_name) VALUES ('$service_name', '$service_provider_name')";
            if ($conn->query($sql) === true) {
                return true;
            } else {
                return false;
        }
    }
    function deleteServiceProviderService($service_name, $service_provider_name){
        global $conn;
        $service_name = $conn->real_escape_string($service_name);
        $service_provider_name = $conn->real_escape_string($service_provider_name);

        $sql = "DELETE FROM service_provider_services WHERE service_name = '$service_name' AND service_provider_name = '$service_provider_name'";
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }
    function updateServiceProviderService($old_service_name, $old_service_provider_name, $new_service_name, $new_service_provider_name){
        global $conn;
        $old_service_name = $conn->real_escape_string($old_service_name);
        $old_service_provider_name = $conn->real_escape_string($old_service_provider_name);
        $new_service_name = $conn->real_escape_string($new_service_name);
        $new_service_provider_name = $conn->real_escape_string($new_service_provider_name);

        $sql = "UPDATE service_provider_services SET service_name = '$new_service_name', service_provider_name = '$new_service_provider_name' WHERE service_name = '$old_service_name' AND service_provider_name = '$old_service_provider_name'";
        if ($conn->query($sql) === true) {
            return true;
        } else {
            return false;
        }
    }

?>

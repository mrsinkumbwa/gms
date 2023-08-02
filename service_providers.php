<!DOCTYPE html>
<html>
<head>
    <title>Admin - Service Providers</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        #h1 {
            text-align: center;
        }
        .addServiceProviderForm {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .addServiceProviderForm h2 {
            text-align: center;
        }
        .addServiceProviderForm label {
            display: block;
            margin-bottom: 5px;
        }
        .addServiceProviderForm input[type="text"],
        .addServiceProviderForm input[type="email"],
        .addServiceProviderForm input[type="tel"],
        .addServiceProviderForm select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .addServiceProviderForm input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .addServiceProviderForm input[type="submit"]:hover {
            background-color: #45a049;
        }
        #serviceProviderTable {
            max-width: 800px;
            margin: 20px auto;
        }
        #serviceProviderTable h2 {
            text-align: center;
        }
        #serviceProviderTable table {
            width: 100%;
            border-collapse: collapse;
        }
        #serviceProviderTable th,
        #serviceProviderTable td {
            padding: 8px;
            border: 1px solid #ccc;
            text-align: center;
        }
        #serviceProviderTable th {
            background-color: #f2f2f2;
        }
        #serviceProviderCount {
            text-align: center;
            font-weight: bold;
        }
        .edit-button, .delete-button, .save-button, .cancel-button {
            padding: 5px 10px;
            margin: 0 3px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .edit-button {
            background-color: #2196F3;
            color: #fff;
        }
        .delete-button {
            background-color: #f44336;
            color: #fff;
        }
        .save-button {
            background-color: #4CAF50;
            color: #fff;
        }
        .cancel-button {
            background-color: #ccc;
        }
    </style>
</head>
<body>
    <h1 id="h1">Managing Service Providers...</h1>
    <div class="addServiceProviderForm">
        <?php
        // Include the database.php file
        include 'database.php';

        // Create a new instance of the Database class
        $database = new Database();

        // Get the database connection
        $conn = $database->getConnection();

        // Query to retrieve the regions data
        $sql = "SELECT * FROM regions";

        // Execute the query
        $result = $conn->query($sql);

        // Initialize an empty array to store the regions data
        $regionsData = array();

        // Fetch data and store it in the array
        while ($row = $result->fetch_assoc()) {
            $regionsData[] = $row;
        }

        // Variables to hold the selected values for form repopulation after submission
        $selectedRegionId = "";
        $service_provider_name = "";
        $email = "";
        $phone = "";
        $address = "";
        $service_name = "";

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Check if the selected_region parameter is set
            if (isset($_POST["selected_region"])) {
                // Retrieve the selected region ID from the form submission
                $selectedRegionId = $_POST["selected_region"];

                // Retrieve the additional fields for Service Providers table
                $service_provider_name = $_POST["service_provider_name"];
                $email = $_POST["email"];
                $phone = $_POST["phone"];
                $address = $_POST["address"];

                // Retrieve the additional fields for Service Provider Services table
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

                echo "<br>Data successfully inserted into the database.";
            } else {
                // Handle the case where no region is selected (optional)
                echo "Please select a region.";
            }
        }

        // Close the database connection
        $database->closeConnection();
        ?>

        <form id="serviceProvidersForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <h2>Add New Service Provider:</h2>
            <select name="selected_region">
                <?php
                // Loop through the regions data and populate the dropdown
                foreach ($regionsData as $region) {
                    $regionId = $region['regionId'];
                    $regionName = $region['regionName'];

                    // Check if the current region is the selected region
                    $selected = ($regionId == $selectedRegionId) ? "selected" : "";

                    echo "<option value='$regionId' $selected>$regionName</option>";
                }
                ?>
            </select>
            <br>

            <!-- Additional fields for Service Providers table -->
            <label for="service_provider_name">Service Provider Name:</label>
            <input type="text" name="service_provider_name" id="service_provider_name" value="<?php echo $service_provider_name; ?>" required>
            <br>

            <label for="email">Email:</label>
            <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>
            <br>

            <label for="phone">Phone:</label>
            <input type="tel" name="phone" id="phone" value="<?php echo $phone; ?>" required>
            <br>

            <label for="address">Address:</label>
            <input type="text" name="address" id="address" value="<?php echo $address; ?>" required>
            <br>

            <!-- Additional fields for Service Provider Services table -->
            <label for="service_name">Service Name:</label>
            <input type="text" name="service_name" id="service_name" value="<?php echo $service_name; ?>" required>
            <br>

            <input type="submit" value="Submit">
        </form>
    </div>

    <div id="serviceProviderTable">
        <!-- Display the number of service providers -->
        <div id="serviceProviderCount">
            Loading service provider count...
        </div>
        <?php
            // Create a new instance of the Database class
            $database = new Database();

            // Get the database connection
            $conn = $database->getConnection();

            // Query to join the service_providers, service_provider_services, and regions tables
            $sqlJoin = "SELECT sp.service_provider_name, sp.email, sp.phone, sp.address, r.regionName, s.service_name 
                        FROM service_providers sp
                        LEFT JOIN service_provider_services s
                        ON sp.service_provider_name = s.service_provider_name
                        LEFT JOIN regions r
                        ON sp.region_id = r.regionId";

            // Execute the query
            $resultJoin = $conn->query($sqlJoin);

            // Check if there are any records to display
            if ($resultJoin->num_rows > 0) {
                echo "<h2>Service Providers Table:</h2>";
                echo "<table border='1'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>Region Name</th>";
                echo "<th>Service Provider Name</th>";
                echo "<th>Email</th>";
                echo "<th>Phone</th>";
                echo "<th>Address</th>";
                echo "<th>Service Name</th>";
                echo "<th>Action</th>"; // New column for action buttons
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                // Loop through the results and display the data in the table
                while ($row = $resultJoin->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['regionName'] . "</td>";
                    echo "<td>" . $row['service_provider_name'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['phone'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td>" . $row['service_name'] . "</td>";
                    echo "<td>";
                    echo "<button class='edit-button' data-name='" . $row['service_provider_name'] . "'>EDIT</button>";
                    echo "<button class='delete-button' data-name='" . $row['service_provider_name'] . "'>DELETE</button>";
                    echo "</td>";
                    echo "</tr>";
                }

                echo "</tbody>";
                echo "</table>";
            } else {
                echo "No service providers found in the database.";
            }

            // Close the database connection
            $database->closeConnection();
        ?>

    </div>

    <script>
        $(document).ready(function () {
        // Function to handle form submission using AJAX
            function submitForm() {
                $.ajax({
                    type: "POST",
                    url: "submit_data.php", // Replace with the actual PHP file to handle form submission
                    data: $("#serviceProvidersForm").serialize(),
                    success: function (response) {
                        // Display the success message in an alert
                        alert("Data successfully inserted into the database.");

                        // Clear the form inputs after successful submission
                        $("#serviceProvidersForm")[0].reset();

                        // Update the service provider count
                        updateServiceProviderCount();
                    },
                    error: function (xhr, status, error) {
                        // Display an alert with the error message if submission fails
                        alert("Error: " + error);
                    },
                });
            }

            // Function to update the service provider count
            function updateServiceProviderCount() {
                $.ajax({
                    type: "GET",
                    url: "get_service_provider_count.php", // Replace with the actual PHP file to get the service provider count
                    dataType: "json",
                    success: function (response) {
                        // Update the displayed service provider count
                        $("#serviceProviderCount").text("Number of Service Providers: " + response.count);
                    },
                    error: function (xhr, status, error) {
                        // Display an alert with the error message if count retrieval fails
                        alert("Error: " + error);
                    },
                });
            }

            // Call the function to update the service provider count on page load
            updateServiceProviderCount();

            // Handle form submission when the submit button is clicked
            $("#serviceProvidersForm").submit(function (event) {
                event.preventDefault();
                submitForm();
            });
            
            // Event delegation for the Edit button
            $(document).on("click", ".edit-button", function () {
                // Retrieve the button element
                var editButton = $(this);

                // Retrieve the row element associated with the clicked Edit button
                var row = editButton.closest("tr");

                // Check if the row is already in edit mode
                if (editButton.hasClass("save-button")) {
                    // Save the edited data and exit edit mode
                    saveRowData(row);
                    return;
                }

                // Enter edit mode

                // Store the original cell contents
                row.find("td:not(:last-child)").each(function () {
                    var cell = $(this);
                    var cellText = cell.text();
                    cell.data("original", cellText); // Store the original value in the cell's data
                    cell.html("<input type='text' value='" + cellText + "'>");
                });

                // Change the button text to "SAVE"
                editButton.text("SAVE");
                editButton.addClass("save-button");

                // Append a Cancel button to the last cell of the row
                row.find("td:last-child").append("<button class='cancel-button'>CANCEL</button>");
            });

            // Event delegation for the Cancel button
            $(document).on("click", ".cancel-button", function () {
                // Retrieve the button element
                var cancelButton = $(this);

                // Retrieve the row element associated with the clicked Cancel button
                var row = cancelButton.closest("tr");

                // Restore the original cell contents
                row.find("td:not(:last-child)").each(function () {
                    var cell = $(this);
                    var originalValue = cell.data("original"); // Retrieve the original value from the cell's data
                    cell.text(originalValue);
                });

                // Remove the Cancel button and exit edit mode
                cancelButton.remove();
                row.find(".edit-button").text("EDIT").removeClass("save-button");
            });

            // Function to save the edited data and exit edit mode
            function saveRowData(row) {
                // Retrieve the button element
                var saveButton = row.find(".save-button");

                // Retrieve the edited values and update the row cell contents
                row.find("td:not(:last-child)").each(function () {
                    var cell = $(this);
                    var inputValue = cell.find("input").val();
                    cell.text(inputValue);
                });

                // Remove the Cancel button and exit edit mode
                row.find(".cancel-button").remove();
                saveButton.text("EDIT").removeClass("save-button");
            }

            $(document).on("click", ".delete-button", function () {
            // Retrieve the button element
            var deleteButton = $(this);

            // Retrieve the row element associated with the clicked Delete button
            var row = deleteButton.closest("tr");

            // Retrieve the service provider name from the data attribute
            var serviceProviderName = deleteButton.data("name");

            // Show a confirmation dialog before proceeding with deletion
            if (confirm("Are you sure you want to delete this service provider?")) {
                // Perform the AJAX call to delete the service provider
                $.ajax({
                    type: "POST",
                    url: "delete_service_provider.php", // Replace with the actual PHP file to handle deletion
                    data: { service_provider_name: serviceProviderName },
                    success: function (response) {
                        // Display the success message in an alert
                        alert("Service provider deleted successfully.");

                        // Remove the deleted row from the table
                        row.remove();

                        // Update the service provider count
                        updateServiceProviderCount();
                    },
                    error: function (xhr, status, error) {
                        // Display an alert with the error message if deletion fails
                        alert("Error deleting service provider: " + error);
                        
                    },
                });
            }

        });

        });
    </script>
</body>
</html>

<?php
// Connect to the database (update with your database credentials)
$servername = "localhost";
$username = "mbanga";
$password = "bite@00427";
$dbname = "heavenly_tomb_db";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get the search query from the AJAX request
$query = $_GET['query'];

// Perform the database query to search across multiple tables
$sql = "
  SELECT *
  FROM (
    SELECT 'regions' AS source, regionName AS result
    FROM regions
    WHERE regionName LIKE '%$query%'
    UNION ALL
    SELECT 'graveyards' AS source, name AS result
    FROM graveyards
    WHERE name LIKE '%$query%'
    UNION ALL
    SELECT 'deceased_persons' AS source, CONCAT(first_name, ' ', last_name) AS result
    FROM deceased_persons
    WHERE first_name LIKE '%$query%' OR last_name LIKE '%$query%'
    UNION ALL
    SELECT 'graves' AS source, status_of_grave AS result
    FROM graves
    WHERE status_of_grave LIKE '%$query%'
    UNION ALL
    SELECT 'service_providers' AS source, service_provider_name AS result
    FROM service_providers
    WHERE service_provider_name LIKE '%$query%'
    UNION ALL
    SELECT 'users' AS source, CONCAT(first_name, ' ', last_name) AS result
    FROM users
    WHERE first_name LIKE '%$query%' OR last_name LIKE '%$query%'
    UNION ALL
    SELECT 'reviews' AS source, review_text AS result
    FROM reviews
    WHERE review_text LIKE '%$query%'
    UNION ALL
    SELECT 'bookings' AS source, num_of_graves AS result
    FROM bookings
    WHERE num_of_graves LIKE '%$query%'
    UNION ALL
    SELECT 'messages' AS source, message_text AS result
    FROM messages
    WHERE message_text LIKE '%$query%'
  ) AS search_results
";

$result = $conn->query($sql);

$searchResults = array();

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $source = $row['source'];
    $resultText = $row['result'];

    $searchResults[] = "[$source] $resultText";
  }
}

// Return the search results as JSON
header('Content-Type: application/json');
echo json_encode($searchResults);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!--navbar-->
    
    <!--leave arevie-->
    <div class="review-card">
        <!--displays the newly created comment-->
        
    </div>
    <form method="post" action="../php/review.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
    
        <label for="surname">Surname:</label><br>
        <input type="text" id="surname" name="surname" required><br><br>
    
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
    
        <input type="submit" value="Submit">
      </form>
</body>
</html>
<?php

$server_name = "localhost";
$username = "root";
$password = "";
$dbname = "heavenly_tomb";

// Establish a connection to the MySQL database
$conn = new mysqli($server_name, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<?php
// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $review = $_POST["review"];
    $created_at = date("Y-m-d H:i:s"); // Get the current date and time

    // Prepare the SQL statement
    // Prepare the SQL statement
    $sql = "INSERT INTO reviews (name, surname, review, created_at) VALUES ('$name', '$surname', '$review', '$created_at')";

    // Execute the query
    if ($conn->query($sql) === true) {
        echo "Review successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// Retrieve all reviews from the database
$sql = "SELECT * FROM reviews";
$result = $conn->query($sql);

//checkk if there are any reviews
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . "<br>";
        echo "Name: " . $row['name'] . "<br>";
        echo "Surname: " . $row['surname'] . "<br>";
        echo "Review: " . $row['review'] . "<br>";
        echo "Created At: " . $row['created_at'] . "<br><br>";
    }
} else {
    echo "No reviews found.";
}


// Close the database connection
$conn->close();

?>
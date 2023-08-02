<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/graveBooking.css">
    <title>Document</title>

</head>

<body>
    <script src="../js/graveBooking.js"></script>
    
    <div class="booking-heading-container">
        <h1 class="book-now-text">Book Now</h1>
        <p class="booking-subtext">To book a grave, simple fill in this form and we will return to you in the next 5 minutes</p>
    </div>
    <form method="post" action="/php/send_email.php">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
    
        <label for="contact">Contact Number:</label><br>
        <input type="text" id="contact" name="contact" required><br><br>
    
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
    
        <label for="message">Message:</label><br>
        <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>
    
        <input type="submit" value="Submit">
      </form>






</body>

</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "heavenly_tomb";

// Establish a connection to the MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $message = $_POST["message"];

    // Prepare the SQL statement
    $sql = "INSERT INTO bookings (name, contact, email, message) VALUES ('$name', '$contact', '$email', '$message')";

    // Execute the query
    if ($conn->query($sql) === true) {
        echo "Review successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    // Close the statement
    $conn->close();
}


?>

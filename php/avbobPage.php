<?php
$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_table = "heavenly_tomb";

$conn = new mysqli($db_host, $db_username, $db_password, $db_table);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST["name"];
$surname = $_POST["surname"];
$reveiw = $_POST["review"];

// Insert the data into the database
$sql = "INSERT INTO reviews (name, surname, review) VALUES ('$name', '$surname', '$review')";
if ($conn->query($sql) === TRUE) {
  echo "Review submitted successfully!";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

//Retrieve reviews from the database
$sql = "SELECT name, surname, review, created_at FROM reviews ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // Output each review
  while ($row = $result->fetch_assoc()) {
    $name = $row["name"];
    $surname = $row["surname"];
    $reveiw = $row["review"];
    $created_at = $row["created_at"];

    // Display the review
    echo "<div>";
    echo "<p>Name: $name</p>";
    echo "<p>Surname: $surname</p>";
    echo "<p>Review: $comment</p>";
    echo "<p>Date: $created_at</p>";
    echo "</div>";
  }
} else {
  echo "No reviews";
}

$conn->close();

?>
<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tp3";

// Connect to the database with sqli driver
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data and prevent SQL injection
$activite = $conn->real_escape_string($_POST['activite']);
$responsable = $conn->real_escape_string($_POST['responsable']);
$max_places = (int)$conn->real_escape_string($_POST['max_places']);


// SQL query to insert data into inscription table
$sql = "INSERT INTO tp3.activity (responsable , name , max_places) 
VALUES ('$responsable', '$activite', '$max_places')";

// Execute the query
if ($conn->query($sql) === TRUE) {
  //echo "New record created successfully";
  header('Location: admin.html');

} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>

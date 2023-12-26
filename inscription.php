<?php
// Database configuration
$host = 'localhost';
$dbname = 'tp3';
$dbuser = 'root';
$dbpass = '';

// Connect to the database with sqli driver
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Get form data and prevent SQL injection
$lnom = $conn->real_escape_string($_POST['lnom']);
$fnom = $conn->real_escape_string($_POST['fnom']);
$bdate = $conn->real_escape_string($_POST['bdate']);
$sexe = $conn->real_escape_string($_POST['sexe']);

// take the value from $_POST['activite'] , split the string on the '-' character and take the first element
$activite = explode('-', $_POST['activite'])[0];
//take the value from $_POST['activite'] , split the string on the '-' character and take the second element
$activity = explode('-', $_POST['activite'])[1];
$motivation = $conn->real_escape_string($_POST['motiv']);


// SQL query to insert data into inscription table
$sql = "INSERT INTO inscription (lname, fname, bdate, sex,  motivation , activity_id)
VALUES ('$lnom', '$fnom', '$bdate', '$sexe', '$motivation' , '$activite')";

// Execute the query
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>

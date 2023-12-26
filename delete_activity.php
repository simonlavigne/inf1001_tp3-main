<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tp3";

// Connect to the database with sqli driver
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$activityId = $_POST['id'];

$sql = "DELETE FROM activity WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $activityId);

if ($stmt->execute()) {
    echo "Record deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

<?php
// Assume a MySQL database with a table named 'Users' with fields 'username' and 'password'.

// Database configuration
$host = 'localhost';
$dbname = 'tp3';
$dbuser = 'root';
$dbpass = '';

// Connect to the database with sqli driver
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}

// get the username and password from the post request
$username = $_POST['user'];
$password = $_POST['password'];

// confirm the username password combination is correct in the database
$query = "SELECT * FROM Users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($query);

// IF the username and password combination is correct, return a success message
if ($result && $result->num_rows > 0) {
    echo json_encode(['success' => 'Login successful']);
    //Return a 200 sucess code
    //http_response_code(200);
} else {
    echo json_encode(['error' => 'Invalid username or password']);
    //Return a 401 unauthorized code
    http_response_code(401);
}

$conn->close();
?>




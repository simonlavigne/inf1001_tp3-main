<?php
// Database configuration
$host = 'localhost';
$dbname = 'tp3';
$dbuser = 'root';
$dbpass = '';

// Create a MySQLi connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to get the number of inscriptions for each activity
$sql = "SELECT a.id,
                a.name
        FROM activity a
        LEFT JOIN 
        (SELECT activity_id , count(*) as inscription_count FROM  inscription GROUP BY activity_id )i 
        ON a.id = i.activity_id
        WHERE (a.max_places - i.inscription_count) > 0 or i.inscription_count IS NULL; 
";

$result = $conn->query($sql);

// Check if we have results
if ($result->num_rows > 0) {
    // Initialize an array to hold the activities data
    $activities = [];

    // Fetch associative array
    while($row = $result->fetch_assoc()) {
        $activities[] = $row;
    }

    // Output the activities in JSON format
    header('Content-Type: application/json');
    echo json_encode($activities);
} else {
    echo "0 results";
}

// Close connection
$conn->close();
?>
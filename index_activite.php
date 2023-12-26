<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tp3";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit();
}
// response is an array that holds the activities data. Instanciate an array
$response = ['activities' => []];

// SQL query to get the number of inscriptions for each activity
$sql = "SELECT  a.id, 
                a.name,
                a.responsable ,
                COUNT(i.id) as num_inscriptions 
        FROM activity a
        LEFT JOIN inscription i 
        ON a.id = i.activity_id
        GROUP BY a.id";

$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
    while($activity = $result->fetch_assoc()) {
        // Add the activity to the response array
        $response['activities'][] = $activity;
    }
}

echo json_encode($response);
// Close connection
$conn->close();
?>

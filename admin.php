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

$response = ['activities' => [], 'inscriptions' => []];

// Fetch activitiesmax_place
$activityQuery = "SELECT activity.id,
                         activity.name,
                         activity.responsable,
                         activity.max_places
                         FROM activity 
                         LEFT JOIN inscription
                         ON activity.id = inscription.activity_id 
                         GROUP BY activity.id";
$activitiesResult = $conn->query($activityQuery);

if ($activitiesResult && $activitiesResult->num_rows > 0) {
    while($activity = $activitiesResult->fetch_assoc()) {
        $response['activities'][] = $activity;
    }
}

// Fetch inscriptions
$inscriptionQuery = "SELECT activity.id,
                            activity.name,
                            activity.max_places,
                            COUNT(inscription.activity_id) AS registered_count
                    FROM activity 
                    LEFT JOIN inscription 
                    ON activity.id = inscription.activity_id 
                    GROUP BY activity.id";
$inscriptionsResult = $conn->query($inscriptionQuery);

if ($inscriptionsResult && $inscriptionsResult->num_rows > 0) {
    while($inscription = $inscriptionsResult->fetch_assoc()) {
        $remainingPlaces = $inscription["max_places"] - $inscription["registered_count"];
        $percentageFilled = ($inscription["registered_count"] / $inscription["max_places"]) * 100;

        $response['inscriptions'][] = [
            'name' => $inscription["name"],
            'id' => $inscription["id"],
            'remainingPlaces' => $remainingPlaces,
            'percentageFilled' => round($percentageFilled)
        ];
    }
}

echo json_encode($response);
$conn->close();
?>

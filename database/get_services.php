<?php
$mysqli = new mysqli("localhost", "root", "", "car_users_db");
$services = [];

$result = $mysqli->query("SELECT * FROM services");
while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

header('Content-Type: application/json');
echo json_encode($services);

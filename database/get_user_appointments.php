<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
$stmt = $mysqli->prepare("
  SELECT a.appointment_date, a.appointment_time, s.title 
  FROM appointments a
  JOIN services s ON a.service_id = s.id
  WHERE a.user_id = ?
  ORDER BY a.appointment_date DESC, a.appointment_time DESC
");
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments);

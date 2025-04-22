<?php
session_start();
header('Content-Type: application/json');

ini_set('display_errors', 0);
error_reporting(0);
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");

$user_id = $_SESSION['user_id'];
$car_model = trim($_POST['car_model']);
$service_id = intval($_POST['service_id']);
$date = $_POST['date'];
$time = $_POST['time'];

// Проверка занятости
$stmt = $mysqli->prepare("SELECT id FROM appointments WHERE appointment_date = ? AND appointment_time = ?");
$stmt->bind_param("ss", $date, $time);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    echo json_encode(['error' => 'This time slot is already booked.']);
    exit;
}

$stmt = $mysqli->prepare("INSERT INTO appointments (user_id, car_model, appointment_date, appointment_time, service_id)
                          VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("isssi", $user_id, $car_model, $date, $time, $service_id);
$stmt->execute();

echo json_encode(['success' => 'Appointment booked successfully!']);

<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");

$id = (int)$_POST['id'];
$field = $_POST['field'];
$value = $_POST['value'];

$allowed = ['date' => 'appointment_date', 'time' => 'appointment_time'];
if (!isset($allowed[$field])) {
    echo json_encode(['error' => 'Invalid field']);
    exit;
}

$stmt = $mysqli->prepare("UPDATE appointments SET {$allowed[$field]} = ? WHERE id = ?");
$stmt->bind_param("si", $value, $id);
$stmt->execute();

echo json_encode(['success' => true]);

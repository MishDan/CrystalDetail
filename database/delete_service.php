<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_POST['id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'DB connection error']);
    exit;
}

$id = (int)$_POST['id'];
$stmt = $mysqli->prepare("DELETE FROM services WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to delete service']);
}

<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
$id = (int)$_GET['id'];

$stmt = $mysqli->prepare("DELETE FROM appointments WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(['success' => true]);

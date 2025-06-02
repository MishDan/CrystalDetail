<?php
header('Content-Type: application/json');
session_start();

// Защита от ошибок
set_error_handler(function ($errno, $errstr) {
    echo json_encode(['error' => "PHP error: $errstr"]);
    exit;
});

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Invalid request']);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_errno) {
    echo json_encode(['error' => 'DB connection failed']);
    exit;
}

$userId = (int)($_POST['userId'] ?? 0);
$role = $_POST['role'] ?? '';

$allowed = ['user', 'moder', 'admin', 'banned'];
if (!in_array($role, $allowed)) {
    echo json_encode(['error' => 'Invalid role']);
    exit;
}

$stmt = $mysqli->prepare("UPDATE users SET role = ? WHERE id = ?");
$stmt->bind_param("si", $role, $userId);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to update']);
}

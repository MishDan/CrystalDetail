<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Unauthorized']);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");

$userId = (int)$_POST['userId'];
$role = $_POST['role'];

$allowed = ['user', 'moder', 'admin', 'banned'];
if (!in_array($role, $allowed)) {
    echo json_encode(['error' => 'Invalid role']);
    exit;
}

$stmt = $mysqli->prepare("UPDATE users SET role = ? WHERE id = ?");
$stmt->bind_param("si", $role, $userId);
$stmt->execute();

echo json_encode(['success' => true]);

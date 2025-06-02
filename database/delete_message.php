<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'unath']);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'error']);
    exit;
}

$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) {
    echo json_encode(['error' => 'error ID ']);
    exit;
}

$stmt = $mysqli->prepare("DELETE FROM messages WHERE id = ?");
$stmt->bind_param("i", $id);
$success = $stmt->execute();

echo json_encode(['success' => $success ? true : false, 'message' => $success ? 'Mesaage deleted' : 'Error deleted']);
$stmt->close();
$mysqli->close();
?>
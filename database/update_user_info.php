<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$id = (int)$_POST['user_id'];

$stmt = $mysqli->prepare("UPDATE users SET first_name = ?, last_name = ?, username = ?, gmail = ?, phone = ?, car_make = ?, car_model = ?, role = ? WHERE id = ?");
$stmt->bind_param(
    "ssssssssi",
    $_POST['first_name'], $_POST['last_name'],
    $_POST['username'], $_POST['gmail'],
    $_POST['phone'], $_POST['car_make'],
    $_POST['car_model'], $_POST['role'], $id
);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to update user.']);
}

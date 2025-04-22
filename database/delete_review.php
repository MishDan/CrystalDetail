<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$id = (int)$_POST['id'];
$stmt = $mysqli->prepare("DELETE FROM reviews WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

echo json_encode(['success' => true]);

<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$id = (int)$_POST['id'];
$title = $_POST['title'];
$description = $_POST['description'];
$icon = $_POST['icon'] ?? '';
$price = $_POST['price'] ?? '';
$duration = $_POST['duration'] ?? '';

$stmt = $mysqli->prepare("UPDATE services SET title=?, description=?, icon=?, price=?, duration=? WHERE id=?");
$stmt->bind_param("sssssi", $title, $description, $icon, $price, $duration, $id);
$stmt->execute();

echo json_encode(['success' => true]);

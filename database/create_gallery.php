<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$stmt = $mysqli->prepare("INSERT INTO gallery (image_url, service) VALUES ('Images_db/placeholder.png', 'New Service')");
$stmt->execute();

$id = $mysqli->insert_id;
$count = $mysqli->query("SELECT COUNT(*) as total FROM gallery")->fetch_assoc()['total'];

echo json_encode(['success' => true, 'id' => $id, 'page' => $count]);

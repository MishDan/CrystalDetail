<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$stmt = $mysqli->prepare("INSERT INTO services (title, description) VALUES ('New Service', 'Description here')");
$stmt->execute();

$id = $mysqli->insert_id;
$count = $mysqli->query("SELECT COUNT(*) as total FROM services")->fetch_assoc()['total'];
$page = $count; // one per page

echo json_encode(['success' => true, 'id' => $id, 'page' => $page]);

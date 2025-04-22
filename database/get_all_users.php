<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * 5;

$total = $mysqli->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$pages = ceil($total / 5);

$stmt = $mysqli->prepare("SELECT id, first_name, last_name, username, gmail, phone, car_make, car_model, role FROM users ORDER BY role DESC LIMIT 5 OFFSET ?");
$stmt->bind_param("i", $offset);
$stmt->execute();
$result = $stmt->get_result();

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode([
    'users' => $users,
    'total_pages' => $pages
]);

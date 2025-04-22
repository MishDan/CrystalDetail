<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 1;
$offset = ($page - 1) * $perPage;

$total = $mysqli->query("SELECT COUNT(*) as total FROM services")->fetch_assoc()['total'];
$pages = ceil($total / $perPage);

$stmt = $mysqli->prepare("SELECT id, title, description, icon, price, duration FROM services LIMIT ? OFFSET ?");
$stmt->bind_param("ii", $perPage, $offset);
$stmt->execute();
$result = $stmt->get_result();

$services = [];
while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

echo json_encode([
    'services' => $services,
    'total_pages' => $pages
]);

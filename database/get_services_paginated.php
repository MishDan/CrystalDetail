<?php
session_start();
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 1;
$offset = ($page - 1) * $perPage;

$total = $mysqli->query("SELECT COUNT(*) as total FROM services")->fetch_assoc()['total'];
$pages = ceil($total / $perPage);

$stmt = $mysqli->prepare("
    SELECT id, 
           title_en, title_ru, title_lv, 
           description_en, description_ru, description_lv, 
           icon, price, duration 
    FROM services 
    LIMIT ? OFFSET ?
");
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

<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 1;
$offset = ($page - 1) * $perPage;

$total = $mysqli->query("SELECT COUNT(*) as total FROM gallery")->fetch_assoc()['total'];
$pages = ceil($total / $perPage);

$result = $mysqli->query("SELECT * FROM gallery ORDER BY id DESC LIMIT $perPage OFFSET $offset");

$images = [];
while ($img = $result->fetch_assoc()) {
    $images[] = $img;
}

echo json_encode([
  'images' => $images,
  'total_pages' => $pages
]);

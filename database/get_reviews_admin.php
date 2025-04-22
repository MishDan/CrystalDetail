<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 5;
$offset = ($page - 1) * $perPage;

$total = $mysqli->query("SELECT COUNT(*) as total FROM reviews")->fetch_assoc()['total'];
$pages = ceil($total / $perPage);

$result = $mysqli->query("SELECT id, name, stars, service, text FROM reviews LIMIT $perPage OFFSET $offset");

$reviews = [];
while ($r = $result->fetch_assoc()) {
    $reviews[] = $r;
}

echo json_encode([
  'reviews' => $reviews,
  'total_pages' => $pages
]);

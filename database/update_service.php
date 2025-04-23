<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$id = (int)$_POST['id'];
$title_en = $_POST['title_en'];
$title_ru = $_POST['title_ru'];
$title_lv = $_POST['title_lv'];
$desc_en = $_POST['description_en'];
$desc_ru = $_POST['description_ru'];
$desc_lv = $_POST['description_lv'];
$icon = $_POST['icon'] ?? '';
$price = $_POST['price'] ?? '';
$duration = $_POST['duration'] ?? '';

$stmt = $mysqli->prepare("UPDATE services SET 
    title_en=?, title_ru=?, title_lv=?, 
    description_en=?, description_ru=?, description_lv=?, 
    icon=?, price=?, duration=? 
    WHERE id=?");

$stmt->bind_param("sssssssssi", 
    $title_en, $title_ru, $title_lv, 
    $desc_en, $desc_ru, $desc_lv,
    $icon, $price, $duration, $id);

$stmt->execute();

echo json_encode(['success' => true]);

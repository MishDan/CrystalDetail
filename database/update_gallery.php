<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$id = (int)$_POST['id'];
$service = $_POST['service'] ?? '';
$caption_en = $_POST['caption_en'] ?? '';
$caption_ru = $_POST['caption_ru'] ?? '';
$caption_lv = $_POST['caption_lv'] ?? '';
$alt_en = $_POST['alt_text_en'] ?? '';
$alt_ru = $_POST['alt_text_ru'] ?? '';
$alt_lv = $_POST['alt_text_lv'] ?? '';

$image_url = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $name = basename($_FILES['image']['name']);
    $target = '../Images_db/' . $name;
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $image_url = 'Images_db/' . $name;
}

if ($image_url) {
    $stmt = $mysqli->prepare("UPDATE gallery 
        SET image_url=?, service=?, 
            caption_en=?, caption_ru=?, caption_lv=?, 
            alt_text_en=?, alt_text_ru=?, alt_text_lv=? 
        WHERE id=?");

    $stmt->bind_param("ssssssssi", $image_url, $service,
        $caption_en, $caption_ru, $caption_lv,
        $alt_en, $alt_ru, $alt_lv, $id);
} else {
    $stmt = $mysqli->prepare("UPDATE gallery 
        SET service=?, 
            caption_en=?, caption_ru=?, caption_lv=?, 
            alt_text_en=?, alt_text_ru=?, alt_text_lv=? 
        WHERE id=?");

    $stmt->bind_param("sssssssi", $service,
        $caption_en, $caption_ru, $caption_lv,
        $alt_en, $alt_ru, $alt_lv, $id);
}

$stmt->execute();
echo json_encode(['success' => true]);

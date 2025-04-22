<?php
session_start();
header('Content-Type: application/json');
if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$id = (int)$_POST['id'];
$service = $_POST['service'] ?? '';
$alt = $_POST['alt_text'] ?? '';
$caption = $_POST['caption'] ?? '';

$image_url = null;
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $name = basename($_FILES['image']['name']);
    $target = '../Images_db/' . $name;
    move_uploaded_file($_FILES['image']['tmp_name'], $target);
    $image_url = 'Images_db/' . $name;
}

if ($image_url) {
    $stmt = $mysqli->prepare("UPDATE gallery SET image_url=?, service=?, alt_text=?, caption=? WHERE id=?");
    $stmt->bind_param("ssssi", $image_url, $service, $alt, $caption, $id);
} else {
    $stmt = $mysqli->prepare("UPDATE gallery SET service=?, alt_text=?, caption=? WHERE id=?");
    $stmt->bind_param("sssi", $service, $alt, $caption, $id);
}

$stmt->execute();
echo json_encode(['success' => true]);

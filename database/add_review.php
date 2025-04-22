<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
  echo json_encode(['error' => 'Not logged in']);
  exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) {
  echo json_encode(['error' => 'Database connection failed']);
  exit;
}

$user_id = $_SESSION['user_id'];
$service = trim($_POST['service'] ?? '');
$text = trim($_POST['text'] ?? '');
$stars = isset($_POST['stars']) ? floatval($_POST['stars']) : 0;

if (!$service || !$text) {
  echo json_encode(['error' => 'Required fields are missing']);
  exit;
}

$stmt = $mysqli->prepare("SELECT first_name, last_name, profile_image FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$stmt->bind_result($first, $last, $profileImage);
$stmt->fetch();
$stmt->close();

$name = "$first $last";
$image = $profileImage ?: 'icon_default_user.png';
$imagePath = "Images_db/" . $image;

$stmt = $mysqli->prepare("INSERT INTO reviews (name, image_url, stars, text, service) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssdss", $name, $imagePath, $stars, $text, $service);

if ($stmt->execute()) {
  echo json_encode(['success' => 'Review submitted successfully!']);
} else {
  echo json_encode(['error' => 'Failed to submit review']);
}
?>

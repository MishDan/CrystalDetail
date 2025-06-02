<?php
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "", "car_users_db");

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';
$service = $_POST['service'] ?? '';
$message = $_POST['message'] ?? '';

if (!$name || !$email || !$message) {
  echo json_encode(['error' => 'missing_required']);
  exit;
}

$stmt = $mysqli->prepare("INSERT INTO messages (name, email, phone, service, message) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $service, $message);

if ($stmt->execute()) {
  echo json_encode(['success' => true]);
} else {
  echo json_encode(['error' => 'db_error']);
}

<?php
session_start();
require_once("connect.php");

// Autentifikācijas pārbaude
if (!isset($_SESSION['user_id'])) {
    die("Unauthorized access.");
}

$user_id = $_SESSION['user_id'];
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];

// E-pasta formāta validācija
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
}

// Sagatavots vaicājums drošībai
$stmt = $conn->prepare("UPDATE users SET name=?, email=?, phone=? WHERE id=?");
$stmt->bind_param("sssi", $name, $email, $phone, $user_id);

if ($stmt->execute()) {
    echo "User info updated successfully!";
} else {
    echo "Database error.";
}
?>

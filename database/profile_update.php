<?php
session_start();
header('Content-Type: application/json');
$mysqli = new mysqli("localhost", "root", "", "car_users_db");

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$userId = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['first_name'])) {
    $stmt = $mysqli->prepare("UPDATE users SET first_name=?, last_name=?, username=?, phone=?, car_make=?, car_model=? WHERE id=?");
    $stmt->bind_param("ssssssi",
        $_POST['first_name'], $_POST['last_name'], $_POST['username'],
        $_POST['phone'], $_POST['car_make'], $_POST['car_model'], $userId
    );
    $stmt->execute();
    echo json_encode(['success' => 'Profile updated successfully']);
    exit;
}

if (isset($_POST['current_password'], $_POST['new_password'])) {
    $stmt = $mysqli->prepare("SELECT password FROM users WHERE id=?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->bind_result($hash);
    $stmt->fetch();
    $stmt->close();

    if (!password_verify($_POST['current_password'], $hash)) {
        echo json_encode(['error' => 'Current password is incorrect']);
        exit;
    }

    $newHash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("UPDATE users SET password=? WHERE id=?");
    $stmt->bind_param("si", $newHash, $userId);
    $stmt->execute();
    echo json_encode(['success' => 'Password updated successfully']);
    exit;
}

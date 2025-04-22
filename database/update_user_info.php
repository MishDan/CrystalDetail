<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Not logged in']);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Database connection error']);
    exit;
}

$user_id = $_SESSION['user_id'];

// Получение текущего изображения
$res = $mysqli->prepare("SELECT profile_image FROM users WHERE id = ?");
$res->bind_param("i", $user_id);
$res->execute();
$res->bind_result($currentImage);
$res->fetch();
$res->close();

$profileImage = $currentImage;

// Обработка нового файла (если загружен)
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === 0) {
    $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
    $newFileName = uniqid("user_", true) . '.' . $ext;
    $targetPath = __DIR__ . "/../Images_db/$newFileName";

    if (move_uploaded_file($_FILES['profile_image']['tmp_name'], $targetPath)) {
        // Удаление старого фото, если не дефолт
        if ($currentImage && $currentImage !== "icon_default_user.png") {
            $oldPath = __DIR__ . "/../Images_db/" . $currentImage;
            if (file_exists($oldPath)) {
                unlink($oldPath);
            }
        }
        $profileImage = $newFileName;
    } else {
        echo json_encode(['error' => 'Failed to upload new profile image.']);
        exit;
    }
}

// Обновление данных
$stmt = $mysqli->prepare("UPDATE users SET first_name=?, last_name=?, username=?, phone=?, car_make=?, car_model=?, profile_image=? WHERE id=?");
$stmt->bind_param(
    "sssssssi",
    $_POST['first_name'],
    $_POST['last_name'],
    $_POST['username'],
    $_POST['phone'],
    $_POST['car_make'],
    $_POST['car_model'],
    $profileImage,
    $user_id
);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['error' => 'Failed to update user']);
}

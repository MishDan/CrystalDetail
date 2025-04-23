<?php
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

$lang = $_GET['lang'] ?? 'en';
if (!in_array($lang, ['en', 'ru', 'lv'])) {
    $lang = 'en';
}

$result = $mysqli->query("
    SELECT image_url, service, 
           alt_text_$lang AS alt_text, 
           caption_$lang AS caption 
    FROM gallery 
    ORDER BY id DESC
");

$images = [];
while ($row = $result->fetch_assoc()) {
    $images[] = $row;
}

echo json_encode($images);

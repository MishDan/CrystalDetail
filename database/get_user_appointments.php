<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");

if ($mysqli->connect_error) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$lang = $_GET['lang'] ?? 'en';
$lang = in_array($lang, ['en', 'ru', 'lv']) ? $lang : 'en';
$field = "title_" . $lang;

$query = "
    SELECT 
        a.car_model, 
        a.appointment_date, 
        a.appointment_time, 
        COALESCE(s.$field, s.title_en) AS title
    FROM appointments a
    JOIN services s ON a.service_id = s.id
    WHERE a.user_id = ?
      AND a.appointment_date >= DATE_SUB(CURDATE(), INTERVAL 14 DAY)
    ORDER BY a.appointment_date DESC, a.appointment_time DESC
";

$stmt = $mysqli->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode($appointments, JSON_UNESCAPED_UNICODE);

<?php
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) exit;

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) exit;

$offset = isset($_GET['page']) ? ((int)$_GET['page'] - 1) * 5 : 0;
$type = $_GET['type'] ?? 'upcoming';

$where = "";
if ($type === 'past') {
    $where = "WHERE a.appointment_date <= CURDATE() AND a.appointment_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
} elseif ($type === 'upcoming') {
    $where = "WHERE a.appointment_date > CURDATE()";
}

// Get total count
$countQuery = $mysqli->query("SELECT COUNT(*) as total FROM appointments a $where");
$total = $countQuery->fetch_assoc()['total'];
$pages = ceil($total / 5);

// Fetch paginated data
$stmt = $mysqli->prepare("SELECT a.id, u.first_name, u.last_name, u.phone, a.car_model, s.title as service, a.appointment_date as date, a.appointment_time as time
FROM appointments a
JOIN users u ON a.user_id = u.id
JOIN services s ON a.service_id = s.id
$where
ORDER BY a.appointment_date DESC, a.appointment_time DESC
LIMIT 5 OFFSET ?");
$stmt->bind_param("i", $offset);
$stmt->execute();
$result = $stmt->get_result();

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode([
    'appointments' => $data,
    'total_pages' => $pages
]);
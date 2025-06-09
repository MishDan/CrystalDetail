<?php
session_start();
header('Content-Type: application/json');

file_put_contents('debug.log', print_r($_SESSION, true) . PHP_EOL);

if (!isset($_SESSION['user_id'])) {
    echo json_encode([]);
    exit;
}

$mysqli = new mysqli("localhost", "root", "", "car_users_db");

if ($mysqli->connect_error) {
    echo json_encode(["error" => "Ошибка подключения к базе данных: " . $mysqli->connect_error]);
    exit;
}

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = 3; 
$offset = ($page - 1) * $limit;

$total_res = $mysqli->query("SELECT COUNT(*) as total FROM messages");
if (!$total_res) {
    echo json_encode(["error" => "Error запроса: " . $mysqli->error]);
    exit;
}
$total_row = $total_res->fetch_assoc();
$total_messages = $total_row['total'];
$total_pages = ceil($total_messages / $limit);

$query = "SELECT * FROM messages ORDER BY created_at ASC LIMIT ? OFFSET ?"; 
$stmt = $mysqli->prepare($query);
if (!$stmt) {
    echo json_encode(["error" => "Ошибка подготовки запроса: " . $mysqli->error]);
    exit;
}
$stmt->bind_param("ii", $limit, $offset);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}

echo json_encode([
    'messages' => $messages,
    'total_pages' => $total_pages
], JSON_UNESCAPED_UNICODE);

$mysqli->close();
?>
<?php
session_start();
header('Content-Type: application/json');

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['appointments' => [], 'total_pages' => 0]);
    exit;
}

// Подключение к БД
$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'DB connection failed']);
    exit;
}

// Настройка языка
$lang = $_SESSION['lang'] ?? 'en'; // можно изменить на 'ru' или 'lv'
$allowedLangs = ['en', 'ru', 'lv'];
if (!in_array($lang, $allowedLangs)) $lang = 'en';
$titleField = "s.title_" . $lang;

// Параметры пагинации
$page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
$offset = ($page - 1) * 5;

// Фильтр по времени
$type = $_GET['type'] ?? 'upcoming';
$where = "";
if ($type === 'past') {
    $where = "WHERE a.appointment_date <= CURDATE() AND a.appointment_date >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";
} elseif ($type === 'upcoming') {
    $where = "WHERE a.appointment_date > CURDATE()";
}

// Получаем общее количество записей
$countQuery = $mysqli->query("SELECT COUNT(*) as total FROM appointments a $where");
$total = $countQuery->fetch_assoc()['total'] ?? 0;
$totalPages = ceil($total / 5);

// Получаем записи
$stmt = $mysqli->prepare("
    SELECT a.id, u.first_name, u.last_name, u.phone, a.car_model, 
           $titleField AS service, a.appointment_date AS date, a.appointment_time AS time
    FROM appointments a
    JOIN users u ON a.user_id = u.id
    JOIN services s ON a.service_id = s.id
    $where
    ORDER BY a.appointment_date DESC, a.appointment_time DESC
    LIMIT 5 OFFSET ?
");
$stmt->bind_param("i", $offset);
$stmt->execute();
$result = $stmt->get_result();

$appointments = [];
while ($row = $result->fetch_assoc()) {
    $appointments[] = $row;
}

echo json_encode([
    'appointments' => $appointments,
    'total_pages' => $totalPages
]);
?>

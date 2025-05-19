<?php
$mysqli = new mysqli("localhost", "root", "", "car_users_db");
$lang = $_GET['lang'] ?? ($_COOKIE['lang'] ?? 'en');

if (!in_array($lang, ['en', 'ru', 'lv'])) {
    $lang = 'en';
}

$query = "SELECT id, icon, price, duration, 
                 title_$lang AS title, 
                 description_$lang AS description 
          FROM services";

$services = [];
$result = $mysqli->query($query);

while ($row = $result->fetch_assoc()) {
    $services[] = $row;
}

header('Content-Type: application/json');   
echo json_encode($services);

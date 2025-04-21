<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "reviews_db";

$conn = new mysqli($host, $user, $password, $db);
$conn->set_charset("utf8");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM reviews ORDER BY id DESC";
$result = $conn->query($sql);

$reviews = [];

while ($row = $result->fetch_assoc()) {
    $reviews[] = $row;
}

echo json_encode($reviews);
?>

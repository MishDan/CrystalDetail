<?php
session_start();
header('Content-Type: application/json');

$mysqli = new mysqli("localhost", "root", "", "car_users_db");
if ($mysqli->connect_error) {
    echo json_encode(['error' => 'Database connection failed']);
    exit;
}

// CSRF check
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    echo json_encode(['error' => 'CSRF token mismatch']);
    exit;
}

$gmail = trim($_POST['gmail'] ?? '');
$password = $_POST['password'] ?? '';
$mode = $_POST['mode'] ?? 'login';

if (empty($gmail) || empty($password)) {
    echo json_encode(['error' => 'Required fields are missing']);
    exit;
}

if ($mode === 'register') {
    $username = !empty($_POST['username']) ? trim($_POST['username']) : null;

    $checkGmail = $mysqli->prepare("SELECT id FROM users WHERE gmail = ?");
    $checkGmail->bind_param("s", $gmail);
    $checkGmail->execute();
    $checkGmail->store_result();
    if ($checkGmail->num_rows > 0) {
        echo json_encode(['error' => 'Email already in use']);
        exit;
    }

    // Username check
    if ($username) {
        $checkUsername = $mysqli->prepare("SELECT id FROM users WHERE username = ?");
        $checkUsername->bind_param("s", $username);
        $checkUsername->execute();
        $checkUsername->store_result();
        if ($checkUsername->num_rows > 0) {
            echo json_encode(['error' => 'Username already taken']);
            exit;
        }
    }

    // Password validation
    if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
        echo json_encode(['error' => 'Password must be at least 8 characters, include letters and numbers']);
        exit;
    }

    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $mysqli->prepare("INSERT INTO users (first_name, last_name, username, gmail, password, car_make, car_model, phone)
                              VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss",
        $_POST['first_name'], $_POST['last_name'], $gmail, $username, $hashed,
        $_POST['car_make'], $_POST['car_model'], $_POST['phone']
    );
    if ($stmt->execute()) {
        echo json_encode(['success' => 'Registration successful!']);
    } else {
        echo json_encode(['error' => 'Registration failed']);
    }

} else {
    // Login
    $stmt = $mysqli->prepare("SELECT id, password FROM users WHERE gmail = ? OR username = ?");
    $stmt->bind_param("ss", $gmail, $gmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $hashed);
        $stmt->fetch();

        if (password_verify($password, $hashed)) {
            $_SESSION['user_id'] = $id;
            echo json_encode(['success' => 'Login successful!']);
        } else {
            echo json_encode(['error' => 'Incorrect password']);
        }
    } else {
        echo json_encode(['error' => 'User not found']);
    }
}
?>

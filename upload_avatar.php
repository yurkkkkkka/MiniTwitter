<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar'])) {
    $avatar = $_FILES['avatar'];
    $uploadDir = 'uploads/';
    $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
    $fileName = uniqid() . '.' . $ext;
    $uploadPath = $uploadDir . $fileName;

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }

    if (move_uploaded_file($avatar['tmp_name'], $uploadPath)) {
        $stmt = $db->prepare("UPDATE users SET avatar = ? WHERE id = ?");
        $stmt->execute([$uploadPath, $_SESSION['user_id']]);
        header('Location: profile.php');
        exit;
    } else {
        echo "Помилка при завантаженні.";
    }
}
?>

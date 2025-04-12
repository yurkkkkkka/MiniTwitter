<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['content'])) {
    $content = trim($_POST['content']);
    if (!empty($content)) {
        $stmt = $pdo->prepare("INSERT INTO tweets (user_id, content, created_at) VALUES (?, ?, NOW())");
        $stmt->execute([$_SESSION['user_id'], $content]);
    }
}

header('Location: index.php');
exit();
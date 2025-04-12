<?php
session_start();
require 'db.php';

if (!isset($_POST['tweet_id'], $_POST['content'])) {
    header("Location: index.php");
    exit();
}

$tweet_id = $_POST['tweet_id'];
$content = trim($_POST['content']);

// Перевірка авторства
$stmt = $pdo->prepare("SELECT user_id FROM tweets WHERE id = ?");
$stmt->execute([$tweet_id]);
$tweet = $stmt->fetch();

if (!$tweet || $tweet['user_id'] != $_SESSION['user_id']) {
    echo "Редагування заборонене.";
    exit();
}

// Оновлення твіту
$stmt = $pdo->prepare("UPDATE tweets SET content = ? WHERE id = ?");
$stmt->execute([$content, $tweet_id]);

header("Location: index.php");
exit();


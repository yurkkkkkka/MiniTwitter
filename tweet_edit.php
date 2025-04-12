<?php
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $db->prepare("SELECT * FROM tweets WHERE id = ? AND user_id = ?");
$stmt->execute([$id, $_SESSION['user_id']]);
$tweet = $stmt->fetch();

if (!$tweet) {
    die("Твіт не знайдено або ви не автор.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $db->prepare("UPDATE tweets SET content = ? WHERE id = ?");
    $stmt->execute([$_POST['content'], $id]);
    header("Location: tweets.php");
    exit;
}
?>

<form method="POST">
    <textarea name="content"><?= htmlspecialchars($tweet['content']) ?></textarea><br>
    <button>Зберегти</button>
</form>

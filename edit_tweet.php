<?php
session_start();
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$tweet_id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM tweets WHERE id = ?");
$stmt->execute([$tweet_id]);
$tweet = $stmt->fetch();

if (!$tweet || $tweet['user_id'] != $_SESSION['user_id']) {
    echo "Доступ заборонено.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Редагувати твіт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Редагувати твіт</h2>
    <form action="update_tweet.php" method="POST">
        <input type="hidden" name="tweet_id" value="<?= $tweet['id'] ?>">
        <div class="mb-3">
            <textarea name="content" class="form-control" rows="4"><?= htmlspecialchars($tweet['content']) ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Оновити</button>
        <a href="index.php" class="btn btn-secondary">Скасувати</a>
    </form>
</body>
</html>


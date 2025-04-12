<?php
require 'db.php';

$stmt = $db->query("SELECT tweets.*, users.username FROM tweets JOIN users ON tweets.user_id = users.id ORDER BY created_at DESC");
$tweets = $stmt->fetchAll();
?>

<a href="index.php">← Назад</a>
<h2>Всі твіти</h2>
<?php foreach ($tweets as $tweet): ?>
    <div style="border:1px solid #ccc; padding:10px; margin:10px;">
        <b><?= htmlspecialchars($tweet['username']) ?></b>:
        <?= htmlspecialchars($tweet['content']) ?><br>
        <small><?= $tweet['created_at'] ?></small>
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $tweet['user_id']): ?>
            <br><a href="tweet_edit.php?id=<?= $tweet['id'] ?>">Редагувати</a>
        <?php endif; ?>
    </div>
<?php endforeach; ?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $text = trim($_POST['tweet']);
    if ($text) {
        $stmt = $pdo->prepare("INSERT INTO tweets (user_id, content, created_at) VALUES (?, ?, datetime('now'))");
        $stmt->execute([$_SESSION['user_id'], $text]);
        header("Location: tweets.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Новий твіт</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">MiniTwitter</a>
    <div class="collapse navbar-collapse justify-content-end">
        <ul class="navbar-nav">
            <li class="nav-item"><a class="nav-link" href="tweets.php">Всі твіти</a></li>
            <li class="nav-item"><a class="nav-link text-danger" href="logout.php">Вийти</a></li>
        </ul>
    </div>
</nav>

<div class="container py-5">
    <h2 class="mb-4 text-center">Створити новий твіт</h2>

    <form method="POST" class="card p-4 shadow-sm mx-auto" style="max-width: 600px;">
        <div class="mb-3">
            <textarea class="form-control" name="tweet" rows="4" placeholder="Що у тебе нового?" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary w-100">Опублікувати</button>
    </form>
</div>

</body>
</html>

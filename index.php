<?php
session_start();
require 'db.php';

// Якщо не залогінений — редирект на логін
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

// Отримуємо твіти з приєднаним ім'ям юзера
$stmt = $pdo->query("
    SELECT tweets.id, tweets.content, tweets.user_id, tweets.created_at, users.username
    FROM tweets
    JOIN users ON tweets.user_id = users.id
    ORDER BY tweets.created_at DESC
");
$tweets = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Міні-Twitter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Ласкаво просимо, <?= htmlspecialchars($_SESSION['username']) ?>!</h2>
            <a href="logout.php" class="btn btn-danger">Вийти</a>
        </div>

        <form action="tweet_create.php" method="POST" class="mb-4">
            <div class="input-group">
                <input type="text" name="content" class="form-control" placeholder="Що думаєш?" required>
                <button class="btn btn-primary">Твітнути</button>
            </div>
        </form>

        <?php foreach ($tweets as $tweet): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($tweet['username']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($tweet['content']) ?></p>
                    <small class="text-muted"><?= $tweet['created_at'] ?></small>

                    <?php if ($tweet['user_id'] == $_SESSION['user_id']): ?>
                        <div class="mt-2">
                            <a href="edit_tweet.php?id=<?= $tweet['id'] ?>" class="btn btn-sm btn-outline-secondary">Редагувати</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</body>
</html>


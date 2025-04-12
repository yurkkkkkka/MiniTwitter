<?php
session_start();
require 'db.php'; // тут вже підключення до MySQL через $pdo

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: index.php");
        exit;
    } else {
        $error = "Невірне ім'я користувача або пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow">
                <div class="card-body">
                    <h3 class="card-title text-center">Вхід</h3>
                    <?php if ($error): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="mb-3">
                            <input name="username" class="form-control" placeholder="Ім’я користувача" required>
                        </div>
                        <div class="mb-3">
                            <input name="password" type="password" class="form-control" placeholder="Пароль" required>
                        </div>
                        <button class="btn btn-primary w-100">Увійти</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="register.php">Ще не зареєстровані?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
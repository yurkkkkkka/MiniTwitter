<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();
?>

<h2>Привіт, <?= htmlspecialchars($user['username']) ?>!</h2>

<?php if ($user['avatar']): ?>
    <img src="<?= htmlspecialchars($user['avatar']) ?>" width="100" height="100" style="border-radius: 50%;">
<?php else: ?>
    <p>Аватар не встановлено</p>
<?php endif; ?>

<form method="POST" action="upload_avatar.php" enctype="multipart/form-data">
    <input type="file" name="avatar" required>
    <button type="submit">Завантажити аватарку</button>
</form>

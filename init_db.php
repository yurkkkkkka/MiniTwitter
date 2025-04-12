<?php
$db = new PDO('sqlite:database.db');

$db->exec("
    CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        username TEXT NOT NULL UNIQUE,
        password TEXT NOT NULL
    );
");

echo "Таблиця 'users' успішно створена!";
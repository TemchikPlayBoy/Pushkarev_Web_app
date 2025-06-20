<?php
require_once 'db.php';
session_start();

// Проверка авторизации
if (!isset($_COOKIE['User'])) {
    header("Location: login.php");
    exit();
}

// Получаем данные пользователя
$current_user = mysqli_real_escape_string($link, $_COOKIE['User']);
$sql = "SELECT * FROM users WHERE username = '$current_user'";
$result = mysqli_query($link, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    setcookie("User", "", time() - 3600);
    header("Location: login.php");
    exit();
}

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Приветствие - <?= htmlspecialchars($user['username']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .welcome-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .user-avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="welcome-container text-center">
            <h1>Привет, <span class="text-primary"><?= htmlspecialchars($user['username']) ?></span>!</h1>
            <p class="lead">Добро пожаловать в вашу учетную запись</p>
            
            <div class="user-details mt-4">
                <div class="mb-3">
                    <strong>Email:</strong> <?= htmlspecialchars($user['email']) ?>
                </div>
                <div class="mb-3">
                    <strong>Дата регистрации:</strong> <?= $user['reg_date'] ?>
                </div>
            </div>
            
            <div class="mt-4">
                <a href="logout.php" class="btn btn-danger">Выйти</a>
            </div>
        </div>
    </div>
</body>
</html>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Приветствие - <?= htmlspecialchars($user['username']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLWZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="welcome-container text-center">
            <h1>Привет, <span class="text-primary"><?= htmlspecialchars($user['username']) ?></span>!</h1>
            <p class="lead">Добро пожаловать в вашу учетную запись</p>
            
            <div class="mt-4">
                <a href="logout.php" class="btn btn-danger">Выйти</a>
            </div>
        </div>
    </div>
</body>
</html>

<?php
require_once('db.php');

if (!isset($_COOKIE['User'])) {
    header("Location: /login.php");
    exit();
}

$link = mysqli_connect('db', 'root', 'Test123', 'first');
$login = mysqli_real_escape_string($link, $_COOKIE['User']);
$sql = "SELECT * FROM users WHERE username='$login'";
$result = mysqli_query($link, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    setcookie("User", "", time() - 3600); // Удаляем куку если пользователь не найден
    header("Location: /login.php");
    exit();
}

$user = mysqli_fetch_assoc($result);
mysqli_close($link);
?>

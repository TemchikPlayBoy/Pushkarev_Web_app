<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PUSHKAREV A.S.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384
    -rbsA2VBKQhggwzxH7pPCaAq046MgnOM80zW1RWuH61DGLWZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="mb-4">Registration</h1>
                <form action="/registration.php" method="post" class="d-flex flex-column gap-3">
                    <input type="text" name="login" class="form-control hacker-input" placeholder="login">
                    <input type="email" name="email" class="form-control hacker-input" placeholder="email">
                    <input type="password" name="password" class="form-control hacker-input" placeholder="password">
                    <button class="btn btn-primary" type="submit" name="submit">Register</button>
                    <p class="mt-3">Already have an account?<a href="/login.php">Login</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
    require_once('db.php');
    
    if (isset($_COOKIE['User'])){ 
    header("Location: /profile.php"); 
    exit(); 
    }
    
    $link = mysqli_connect('db', 'root', 'Test123', 'first');
    
    if (isset($_POST['submit'])) { 
    $login = $_POST['login']; 
    $email = $_POST['email']; 
    $pass = $_POST['password']; 
    
    if (!$login || !$email || !$pass){
     die ("input all parameters");
    }
    $sql = "INSERT INTO users (username, email, pass) VALUES ('$login', '$email', '$pass')";
    
    if(!mysqli_query($link, $sql)) { 
    echo "Не удалось добавить пользователя"; 
    } else { 
    	header("Location: /login.php"); 
    	exit(); 
    }
}
?>
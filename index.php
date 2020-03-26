<?php
    session_start();


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация и регистрация</title>
</head>
<body>
<form action="vendor/signin.php" method="post" style="margin-top: 25vh">
    <div class="registr">
    <h2 style="margin-bottom: 50px; text-align: center">Авторизация</h2>
    <input type="text" name="login" placeholder="Логин">
    <div class="password_cont">
    <input type="password" id="password-input" name="password" placeholder="Пароль">
    <a href="#" class="password-control" onclick="return show_hide_password(this);"></a>
    </div>
    <script>
        function show_hide_password(target){
            let input = document.getElementById('password-input');
            if (input.getAttribute('type') == 'password') {
                target.classList.add('view');
                input.setAttribute('type', 'text');
            } else {
                target.classList.remove('view');
                input.setAttribute('type', 'password');
            }
            return false;
        }
    </script>
    <button type="submit" class="in">Войти</button>
    </div>
    <div class="reg">
    <p>
        У вас нет аккаунта?  <a href="/register.php" style="color: blue">Зарегистрироваться</a>
    </p>
    </div>
    <?php
    if($_SESSION['message']){
        echo '<p class="msg">' . $_SESSION['message'] . '</p>';
    }
    unset($_SESSION['message']);
    ?>
</form>
</body>
</html>
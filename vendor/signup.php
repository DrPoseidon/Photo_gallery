<?php
    session_start();
    require_once 'connect.php';

    $full_name = $_POST['full_name'];
    $login = $_POST['login'];
    $email= $_POST['email'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if($password === $password_confirm){
        $avatar = 'uploads/' . time() . $_FILES['user_photo']['name'];
        if(!move_uploaded_file($_FILES['user_photo']['tmp_name'],'../' . $avatar)){
            $_SESSION['message'] = 'Ошибка при загрузки изображения!';
            header('Location: ../register.php');
        }

       $stmt = $connection->prepare('insert into users(login,password,email,avatar,full_name) values (?,?,?,?,?)');
       $stmt->execute([$login, md5($password), $email, $avatar,$full_name]);
       $_SESSION['message'] = 'Регистрация прошла успешно!';
       header('Location: ../index.php');

    } else{
        $_SESSION['message'] = 'Пароли не совпадают!';
        header('Location: ../register.php');
    }



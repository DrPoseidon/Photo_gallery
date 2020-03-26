<?php
    session_start();
    require_once 'connect.php';

$name = $_POST['full_name'];
$login = $_POST['login'];
$email = $_POST['email'];
$pass = $_POST['password'];
$pass_confirm = $_POST['password_confirm'];

if ($pass === $pass_confirm) {
    $avatar = 'uploads/' . time() . $_FILES['user_photo']['name'];
    if (!move_uploaded_file($_FILES['user_photo']['tmp_name'], '../' . $avatar)) {
        header('Location: ../index.php');
    }


    $stmt = $connect->prepare("insert into users(login,password,email,avatar,full_name) values (:login,:password,:email,:avatar,:full_name)");
    $stmt->execute(array(
        'login' => $login,
        'password' => md5($pass),
        'email' => $email,
        'avatar' => $avatar,
        'full_name' => $name
    ));
    header('Location: ../index.php');

}



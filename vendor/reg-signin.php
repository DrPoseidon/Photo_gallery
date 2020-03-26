<?php
session_start();
require_once 'connect.php';

$login = $_POST['anoter_profile'];

$query = 'select u.full_name,u.login,u.avatar,u.email,p.photo_path from users as u
left join photos as p on u.login = p.login
where u.login = ?';
$stmt = $connection->prepare($query);
$stmt->bindValue(1,$login);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
if($count > 0){
    foreach ($result as $row){
        $array = ['login' => $row['login'],'email' => $row['email'], 'full_name' =>$row['full_name'],'avatar' =>$row['avatar']];
        $_SESSION['row'] = [
            'login' => $row['login'],
            'full_name' => $row['full_name'],
            'email' => $row['email'],
            'avatar' => $row['avatar']
        ];
    }
    header('Location: ../profile.php');
} else{
    $_SESSION['message'] = 'Пароли не совпадают!';
    header('Location: ../index.php');
}













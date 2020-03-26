<?php
session_start();
require_once ('connect.php');

$login = $_SESSION['row']['login'];
$photo_pub_date = date("d.m.Y");
$photo_path = 'uploads/' . time() . $_FILES['add_photo']['name'];
if(!move_uploaded_file($_FILES['add_photo']['tmp_name'],'../' . $photo_path)){
    $_SESSION['message'] = 'Ошибка при загрузки изображения!';
    header('Location: ../profile.php');
    exit();
}


$stmt = $connection->prepare('insert into photos(login,photo_path) values (?,?)');
$stmt->bindValue(1,$login);
$stmt->bindValue(2,$photo_path);
$stmt->execute();
#$result = $stmt->fetch(PDO::FETCH_ASSOC);
header('Location: ../profile.php');











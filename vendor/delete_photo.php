<?php
session_start();
require_once ('connect.php');


$photo = $_GET['ph'];
$stmt = $connection->prepare('select photo_id from photos where photo_path = ?');
$stmt->bindValue(1,$photo);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$photo_id = $result['photo_id'];

$photo = $_GET['ph'];
$stmt = $connection->prepare('select login from photos where photo_id = ?');
$stmt->bindValue(1,$photo_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$login = $result['login'];
if($login != $_SESSION['row']['login']){
    $_SESSION['message'] = 'Нельзя удалить чужое изображение!';
    header('Location: ../photo.php?ph='.$photo.'');
    exit();
}

$stmt = $connection->prepare('delete from comments where photo_id = ?');
$stmt->bindValue(1,$photo_id);
$stmt->execute();


$stmt = $connection->prepare('delete from photos where photo_id = ?');
$stmt->bindValue(1,$photo_id);
$stmt->execute();



header('Location: ../profile.php' . $photo_path . '');
























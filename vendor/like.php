<?php
session_start();
require_once ('connect.php');

$photo_path = $_SESSION['arr']['photo'];
$stmt = $connection->prepare('select photo_id from photos where photo_path = ?');
$stmt->bindValue(1,$photo_path);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$photo_id = $result['photo_id'];
$stmt = $connection->prepare('select login,photo_id from rating where login = ? and photo_id = ?');
$stmt->bindValue(1,$_SESSION['row']['login']);
$stmt->bindValue(2,$photo_id);
$stmt->execute();
if($stmt->rowCount()){
    $_SESSION['message'] = 'Лайк уже поставлен!';
    header('Location: ../photo.php?ph='.$photo_path.'');
    exit();
}

$stmt = $connection->prepare('insert into rating(photo_id,login,rating_value) values (?,?,1)');
$stmt->bindValue(1,$photo_id);
$stmt->bindValue(2,$_SESSION['row']['login']);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
header('Location: ../photo.php?ph='.$photo_path.'');















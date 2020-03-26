<?php
session_start();
require_once ('connect.php');

$com_text = $_POST['comment'];
$photo_path = $_SESSION['arr']['photo'];
if(empty($com_text) > 0){
        $_SESSION['message'] = 'Пустой комментарий!';
    header('Location: ../photo.php?ph='.$photo_path.'');
    exit();
}

$stmt = $connection->prepare('select photo_id from photos where photo_path = ?');
$stmt->bindValue(1,$photo_path);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$login = $_SESSION['row']['login'];
$photo_id = $result['photo_id'];
$com_pub_date = date("d.m.Y");

$stmt = $connection->prepare('insert into comments(photo_id,login,com_text) values (?,?,?)');
$stmt->bindValue(1,$photo_id);
$stmt->bindValue(2,$login);
$stmt->bindValue(3,$com_text);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

header('Location: ../photo.php?ph='.$photo_path.'');















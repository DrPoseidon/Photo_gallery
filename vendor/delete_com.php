<?php
session_start();
require_once ('connect.php');

$com_text = $_GET['ct'];
$photo_path = $_SESSION['arr']['photo'];
$stmt = $connection->prepare('select com_id from comments where com_text = ?');
$stmt->bindValue(1, $com_text);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$com_id = $result['com_id'];

$stmt = $connection->prepare('select login from comments where com_id = ?');
$stmt->bindValue(1, $com_id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);

if($res['login'] != $_SESSION['row']['login']){
    $_SESSION['message'] = 'Нельзя удалить чужой комментарий!';
    header('Location: ../photo.php?ph='.$photo_path.'');
    exit();
}


$stmt = $connection->prepare('delete from comments where com_id = ?');
$stmt->bindValue(1, $com_id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();

header('Location: ../photo.php?ph=' . $photo_path . '');
























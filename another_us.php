<?php
require_once('vendor/connect.php');
$login = $_GET['login'];

$query = 'select login,full_name,email,avatar from users where login = ?';
$stmt = $connection->prepare($query);
$stmt->bindValue(1,$login);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
if($count > 0) {
    foreach ($result as $t){
        $array = ['login' => $t['login'],'email' => $t['email'], 'full_name' =>$t['full_name'],'avatar' =>$t['avatar']];
    }
}

$photo_array = array();
$query = 'select photo_path from photos 
where login = ? ';
$stmt = $connection->prepare($query);
$stmt->bindValue(1,$login);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
if($count > 0){
    foreach ($result as $row){
        array_push($photo_array,$row['photo_path']);
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Авторизация и регистрация</title>
</head>
<body style="display: flex; justify-content: center; flex-direction: column;">
<div class="profile_cont">
<img class="avatar" src="<?= $array['avatar'] ?>" alt=""/>
 <div style="padding: 20px; font-size: 15px">
     <h2><?=$array['login'] ?></h2>
    <h2><?=$array['full_name'] ?></h2>
    <a href="#"><?= $array['email'] ?></a>
</div>
</div>
<a href="profiles.php" class="logout" ">Назад</a>
<div class="photo_cont" style="display: flex; flex-direction:row; align-items: center; width: 1000px;  flex-wrap: wrap;">
    <?php
    foreach ($photo_array as $p){
        echo '<a href="photo.php?ph='.$p.'"><img class ="profile_photo" src="'.$p.'" width="200px" /></a>';
    }
    ?>
</div>

</body>
</html>

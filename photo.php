<?php
session_start();
require_once 'vendor/connect.php';
$photo = $_GET['ph'];
$arr = array();
$_SESSION['arr'] = [
  'photo' => $photo
];
$com_array = array();
$stmt = $connection->prepare('select photo_id from photos where photo_path = ?');
$stmt->bindValue(1,$photo);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$photo_id = $result['photo_id'];
$stmt = $connection->prepare('select u.avatar, u.login, c.com_id, c.com_text from users as u left join comments as c on u.login = c.login
where photo_id = ?');
$stmt->bindValue(1,$photo_id);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
$count = $stmt->rowCount();
$stmt = $connection->prepare('select sum(rating_value) from rating where photo_id = ?');
$stmt->bindValue(1,$photo_id);
$stmt->execute();
$res = $stmt->fetch(PDO::FETCH_ASSOC);
$like_count = $res['sum'];
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
<?php echo '<img class ="p_photo" src="'.$photo.'" style="width= 400px;" />';
?>
<?php
if($_SESSION['message']){
    echo '<p class="msg">' . $_SESSION['message'] . '</p>';
}
unset($_SESSION['message']);
?>
<div class="likes" style="display: flex;flex-direction: row;align-items: center;">
    <div class="like_c" style="margin: 10px;"><?= $like_count?></div>
<a href="vendor/like.php" style="margin: 10px;"><img src="img/like.png" alt="" style="width: 20px"></a>
<a href="vendor/dislike.php" style="margin: 10px;"><img src="img/dislike.png" alt=""style="width: 20px"></a>
    <?php
        echo '<a href="vendor/delete_photo.php?ph='.$photo.'" style="width: 10%;"><img src="img/delete.png" alt="" style="width: 15px;margin-left: 10px"></a>';

    ?>
</div>

<div class="buttons">

<a href="#" OnClick="history.back();" class="logout" ">Назад</a>
<a href="profile.php" class="in_prof">В профиль</a>
</div>
<div class="com_cont">
    <form class="ont" action="vendor/comment.php" method="post">
<input type="text" name="comment" style="resize:none;width: 500px; height: 100px; font-size: 20px; padding: 5px;" placeholder="Напишите комментарий"></input>
<button class="sent" type="submit">Отправить</button>
</form>
</div>
<div class="comments">
    <?php

    foreach ($result as $p){
        echo '<div class="c">';
        echo '<img class = "mini_avatar"src="'.$p['avatar'].'">';
        echo '<div class="lg">'.$p['login'].'</div>';
        echo '<div class="com">'.$p['com_text'].'</div>';
        echo '<a href="vendor/delete_com.php?ct='.$p['com_text'].'" style="width: 10%;"><img src="img/delete.png" alt="" style="width: 15px;margin-left: 10px"></a>';
        echo '</div>';
    }
    ?>
</div>
</body>
</html>

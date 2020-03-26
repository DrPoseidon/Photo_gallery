<?php
session_start();
if(!$_SESSION['row']){
    header('Location: /');
}

require_once 'vendor/connect.php';
$photo_array = array();
$query = 'select photo_path from photos 
where login = ? ';
$stmt = $connection->prepare($query);
$stmt->bindValue(1,$_SESSION['row']['login']);
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
<img class="avatar" src="<?= $_SESSION['row']['avatar'] ?>" alt=""/>
 <div style="padding: 20px; font-size: 15px">
    <h2><?=$_SESSION['row']['login'] ?></h2>
    <h2><?=$_SESSION['row']['full_name'] ?></h2>
     <a href="#"><?= $_SESSION['row']['email'] ?></a>
 </div>

<form action="vendor/add_photo.php" method="post" enctype="multipart/form-data">
    <input type="file" name="add_photo" id="file" class="inputfile" style="border: none">
    <label class="label_profile" for="file" >Выбрать фото</label>
    <button class="btn-profile" type="submit">Добавить фото</button>
</form>
<a href="vendor/logout.php" class="logout">Выход</a>
</div>
<div class="profiles" style="margin-bottom: 20px;">
    <a href="profiles.php" style="background-color: green;
    color: white;
    padding: 10px;
    border-radius: 3px;
    margin: 20px;
    font-weight: 600;">Пользователи</a>

</div>
<div class="photo_cont" style="display: flex; flex-direction:row; align-items: center; width: 1000px;  flex-wrap: wrap;">
    <?php
    foreach ($photo_array as $p){
        echo '<a href="photo.php?ph='.$p.'"><img class ="profile_photo" src="'.$p.'" width="200px" /></a>';
    }
    ?>
</div>
<?php
if($_SESSION['message']){
    echo '<p class="msg">' . $_SESSION['message'] . '</p>';
}
unset($_SESSION['message']);
?>


</body>
</html>
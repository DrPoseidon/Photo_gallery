<?php
session_start();
if(!$_SESSION['row']){
    header('Location: /');
}

require_once 'vendor/connect.php';

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

<a href="profile.php" class="logout" ">Назад</a>
<div class="profiless">
    <?php
    $query = 'select login,avatar from users where login != ? ';
    $stmt = $connection->prepare($query);
    $stmt->bindValue(1,$_SESSION['row']['login']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if($count > 0){
    foreach ($result as $t){
        echo ' <div class = "user"><label class="prof"">'.$t['login'].'</label><a href="another_us.php?login='.$t['login'].'"><img class="avatar" src="'.$t['avatar'].'" alt=""/></a></div>';

    }
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
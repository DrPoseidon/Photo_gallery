<?php
$connection = new PDO('pgsql:host = localhost;dbname = Gallery_db','postgres','Converse2020');
if(!$connection){
    die('Error connect to db!');
}

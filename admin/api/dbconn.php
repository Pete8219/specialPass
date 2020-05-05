<?php

$host ="localhost";
$db = "devPass";
$table = "inform";
$user = "dev";
$password= "123456";


$conn = mysqli_connect($host, $user, $password, $db);
if(!$conn) {
    echo "Ошибка соединения с базой данных". PHP_EOL;
}





?>
<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../helper.php';

$login = $_POST['login'];
$password = $_POST['password'];

$sql = "SELECT * FROM `user` WHERE name = '$login' AND password = '$password'";
$result = $conn -> query($sql);


if($result -> num_rows > 0){
    $row = $result->fetch_assoc();

    setcookie('user', $row['id_user'], time() + 3600 * 24, "/");
    header ("Location: /Linguist Hub\main.php");

}else{
    echo"No";
}


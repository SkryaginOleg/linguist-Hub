<?php

require_once __DIR__ . '/../db.php';


$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

$sql = "INSERT INTO `user` (name, login, password) VALUES ('$login', '$email', '$password')";
$conn->query($sql);

//header("Location: '/Linguist Hub\main.php'");


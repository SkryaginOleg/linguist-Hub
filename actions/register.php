<?php

require_once __DIR__ . '/../db.php';


$login = $_POST['login'];
$email = $_POST['email'];
$password = $_POST['password'];
$repassword = $_POST['repassword'];

$default_image_path = "../IMG/user_male4-256.webp";
$default_user_photo = 'data:image/jpeg;base64, ' . base64_encode(file_get_contents($default_image_path));

$sql = "INSERT INTO `User` (full_name, email, password, photo) VALUES ('$login', '$email', '$password', '$default_user_photo')";
$conn->query($sql);

//header("Location: '/Linguist Hub\main.php'");
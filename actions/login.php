<?php
require_once __DIR__ . '/../DataBase/db.php';

$login = $_POST['login'];
$password = $_POST['password'];


$sql = "SELECT * FROM `User` WHERE email = '$login' AND password = '$password' FOR UPDATE";
$pass = md5($password);
setcookie('pass', $pass, time() + 0,'/');
$sql = "SELECT * FROM `User` WHERE email = '$login' AND password = '$pass' FOR UPDATE";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    session_start();
    $_SESSION['user'] = $row['user_id'];
    setcookie('user', $row['user_id'], time() + 3600 * 24, "/");
    
    $conn->commit();
    header("Location: ../index.php");
} else {
    exit;
}
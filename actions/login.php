<?php

require_once __DIR__ . '/../DataBase/db.php';

$login = $_POST['login'];
$password = $_POST['password'];


$sql = "SELECT * FROM `User` WHERE email = '$login' AND password = '$password' FOR UPDATE";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();

    setcookie('user', $row['user_id'], time() + 3600 * 24, "/");
    session_start();
    $_SESSION['user'] = $row['user_id'];

    $conn->commit();
    header("Location: ../index.php");
} else {
    echo "No";
}
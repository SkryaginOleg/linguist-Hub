<?php

require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../helper.php';

$login = $_POST['login'];
$password = $_POST['password'];

try {
    $stmt = $pdo->prepare("SELECT * FROM `user` WHERE name = :login AND password = :password");
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row) {
        setcookie('user', $row['id_user'], time() + 3600 * 24, "/");
        header("Location: /Linguist Hub/main.php");
    } else {
        echo "No";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>


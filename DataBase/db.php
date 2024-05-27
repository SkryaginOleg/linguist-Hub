<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "LinguistHub";

    //MySqli
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn){
        die("Connection Fialed". mysqli_connect_error());
    }

    //PDO
    try {
        $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8";
        $pdo = new PDO($dsn, $username, $password);
    
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>
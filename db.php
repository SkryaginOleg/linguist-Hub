<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lingusticSchool";

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

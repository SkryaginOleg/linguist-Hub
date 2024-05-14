<?php
require_once 'db.php';

$id_course = $_GET['id'];
$action = $_GET['action'];

function addToBasket($pdo, $id_course) {
    if(isset($_COOKIE['user'])) {
        $userId = $_COOKIE['user'];
    } else {
        echo "X";
        return;
    }
    
    try {
        $stmt = $pdo->prepare("INSERT INTO basket (status, id_user, id_course) VALUES ('X', :userId, :id_course)");
        $stmt->bindParam(':userId', $userId);
        $stmt->bindParam(':id_course', $id_course);
        $stmt->execute();
        header("Location: /Linguist Hub/main.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

function delFromBasket($pdo, $id_course) {
    if(isset($_COOKIE['user'])) {
        $userId = $_COOKIE['user'];
    } else {
        echo "X";
        return;
    }
    
    try {
        $stmt = $pdo->prepare("DELETE FROM basket WHERE id_course = :id_course");
        $stmt->bindParam(':id_course', $id_course);
        $stmt->execute();
        header("Location: /Linguist Hub/bascet.php");
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}

if($action == "false") {
    addToBasket($pdo, $id_course);
} else if($action == "true") {
    delFromBasket($pdo, $id_course);
}
?>

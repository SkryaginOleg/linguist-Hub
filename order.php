<?php

$id_course = $_GET['id'];
$action = $_GET['action'];

function addToBasket($id_course){
    require_once 'db.php'; 
    if(isset($_COOKIE['user'])) {
        $userId = $_COOKIE['user'];
    } else {
        echo"X";
    }
        $sql = "INSERT INTO basket (status, id_user, id_course) VALUES ('X', '$userId', '$id_course')";
        $conn -> query($sql);
        header ("Location: /Linguist Hub\main.php");
}

function delFromBasket($id_course){
    require_once 'db.php'; 
    if(isset($_COOKIE['user'])) {
        $userId = $_COOKIE['user'];
    } else {
        echo"X";
    }
    $sql = "DELETE FROM basket WHERE id_course = $id_course";
    $conn->query($sql);
    header("Location: /Linguist Hub\bascet.php");
}
if($action == "false"){
    addToBasket($id_course);
    }
else if($action == "true"){
    delFromBasket($id_course);
    }

?>
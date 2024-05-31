<?php

require_once("DataBase/db.php");

$user_to_del = $_GET["delid"];
$user_base = intval($_COOKIE["user"]);
$query = 'DELETE FROM Friends WHERE User_id1 = '.$user_base.' AND User_id2 = '.$user_to_del.'';
$conn->query($query);

header('Location: friend.php');


?>
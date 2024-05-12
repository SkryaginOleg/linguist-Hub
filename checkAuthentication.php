<?php

require_once 'db.php';

if (isset($_POST['registration'])) {
    if ($_POST['registration']) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        

        $sql = "SELECT * FROM `user` WHERE login = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo json_encode(array('result' => 'error'));
        } else {
            echo json_encode(array('result' => 'success'));
            require_once 'db.php';
            $sql = "INSERT INTO `user` (name, login, password) VALUES ('$login', '$email', '$password')";
            $conn->query($sql);
        }
    } else if ($_POST['authorization']) {
    }
}

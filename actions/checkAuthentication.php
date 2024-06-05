<?php

require_once __DIR__ . '/../DataBase/db.php';

if (isset($_POST['registration'])) {
    if ($_POST['registration']) {
        $login = $_POST['login'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        try {

            $pdo->beginTransaction();

            $check_sql = "SELECT * FROM `User` WHERE email = :email FOR UPDATE";
            $check_stmt = $pdo->prepare($check_sql);
            $check_stmt->bindParam(':email', $email);
            $check_stmt->execute();

            if ($check_stmt->rowCount() > 0) {

                $pdo->rollBack();
                echo json_encode(array('result' => 'error', 'message' => 'User already exists'));
            } else {
                $default_image_path = "../IMG/user_male4-256.webp";
                $default_user_photo = file_get_contents($default_image_path);
                $password = md5($password);
                $insert_sql = "INSERT INTO `User` (full_name, email, password, photo) VALUES (:login, :email, :password, :default_user_photo)";
                $insert_stmt = $pdo->prepare($insert_sql);
                $insert_stmt->bindParam(':login', $login);
                $insert_stmt->bindParam(':email', $email);
                $insert_stmt->bindParam(':password', $password);
                $insert_stmt->bindParam(':default_user_photo', $default_user_photo);
                $insert_stmt->execute();


                $pdo->commit();
                echo json_encode(array('result' => 'success'));
            }
        } catch (PDOException $e) {

            $pdo->rollBack();
            echo json_encode(array('result' => 'error', 'message' => $e->getMessage()));
        }
    } else if ($_POST['authorization']) {
    }
}

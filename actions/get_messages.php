<?php
error_reporting(E_ALL);
date_default_timezone_set('Europe/Kiev');
session_start();

require_once __DIR__ . '/../DataBase/db.php';

if (!isset($_GET['action'])) {

    $lastId = $_GET['lastId'] ? $_GET['lastId'] : 0;
    $chat_id = $_GET['chat_id'] ? $_GET['chat_id'] : -1;

    $sql = " SELECT message_id, chat_id, Message.user_id, text, time, User.photo, User.full_name FROM Message JOIN User ON Message.user_id = User.user_id WHERE message_id > " . $lastId . " AND chat_id = " .  $chat_id . " ORDER BY time LIMIT 100";
    try {
        $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as &$row) {
            if (isset($row['photo'])) {
                $row['photo'] = base64_encode($row['photo']);
            }
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    } catch (PDOException $e) {
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        echo 'Error: ' . $e->getMessage();
    }
} 

elseif ($_GET['action'] == 'add_message') {

    $message = ($_POST['message']) ? $_POST['message'] : '';
    $chat_id = $_GET['chat_id'] ? $_GET['chat_id'] : -1;
    $datetime = date("Y-m-d H:i:s");
    //$userId = intval($_COOKIE['user']);
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : '';

    $sql = "INSERT INTO Message (`chat_id`, `user_id`, `text`, `time`) VALUES ('" . $chat_id . "', '" . $userId . "', '" . $message . "', '" . $datetime . "');";

    try {
        $result = $pdo->exec($sql);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    } catch (PDOException $e) {
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        echo 'Error: ' . $e->getMessage();
    }
} 

elseif ($_GET['action'] == 'get_chat') {
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : '';

    $sql = "SELECT Chat.chat_id, Chat.date, Chat.name, Chat.photo, Member.member_id FROM Chat JOIN Member ON Member.chat_id = Chat.chat_id AND Member.user_id = " . $userId . ";";
    try {
        $result = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        $default_image_path = "../IMG/user_male4-256.webp";
        $default_image_group_path = "../IMG/group_icon.webp";

        $default_user_photo = 'data:image/jpeg;base64, ' . base64_encode(file_get_contents($default_image_path));
        $default_user_group_photo = 'data:image/jpeg;base64, ' . base64_encode(file_get_contents($default_image_group_path));
    
        $default_user_name = 'Default Name';

        foreach ($result as &$row) {
            $user_photo = $default_user_photo;
            $user_name = $default_user_name;
            
            $sql_count = "SELECT COUNT(DISTINCT user_id) AS users_count FROM Member WHERE chat_id = " . $row['chat_id'] . ";";
            $stmtsql_count = $pdo->query($sql_count);
            $users_count = $stmtsql_count->fetchColumn();

            if ($users_count == 2) {
                $userId = isset($_SESSION['user']) ? $_SESSION['user'] : '';

                $sql_user = "SELECT User.photo, User.full_name 
                              FROM User 
                              JOIN Member ON User.user_id = Member.user_id 
                              WHERE Member.chat_id = " . $row['chat_id'] . " 
                              AND Member.user_id != " . $userId . ";";

                $stmt_user = $pdo->query($sql_user);
                $result_user = $stmt_user->fetch(PDO::FETCH_ASSOC);

                if ($result_user) {
                    if (isset($result_user['photo'])) {
                        $user_photo = 'data:image/jpeg;base64, ' . base64_encode($result_user['photo']);
                    } 
                    if (isset($result_user['full_name'])) {
                        $user_name = $result_user['full_name'];
                    } 
                } 
            }

            if (isset($row['photo'])) {
                $row['photo'] = 'data:image/jpeg;base64, ' . base64_encode($row['photo']);
            } 
            else if ($users_count == 2) {
                $row['photo'] = $user_photo;
            }
            else{
                $row['photo'] = $default_user_group_photo;
            }
            if (!isset($row['name'])) {
                $row['name'] = $user_name;
            }
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($result);
    } catch (PDOException $e) {
        echo '<pre>';
        print_r($sql);
        echo '</pre>';
        echo 'Error: ' . $e->getMessage();
    }
}

//PROFILE   //PROFILE   //PROFILE   //PROFILE   //PROFILE   //PROFILE   //PROFILE   //PROFILE   //PROFILE   //PROFILE   //PROFILE

elseif ($_GET['action'] == 'get_user') {
    
    if(isset($_COOKIE['id'])) {
    $userId = $_COOKIE['id'];
    setcookie('id', $userId, time() + 0);
    }
    else{
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);
    }
    if (!empty($userId)) {
        $sql = "SELECT full_name, email, country, information, birthday, ban_status, password, photo FROM User WHERE user_id = :userId";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as &$row) {
                if (!empty($row['photo'])) {
                    $row['photo'] = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
                }
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($result);
        } catch (PDOException $e) {
            error_log('Database query error: ' . $e->getMessage());

            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid User ID']);
    }
}


elseif ($_GET['action'] == 'get_friends') {
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : '';

    if (!empty($userId)) {
        $sql = "SELECT u.user_id, u.full_name, u.email, u.country, u.information, u.birthday, u.ban_status, u.photo 
                FROM User u
                JOIN Friends f ON (u.user_id = f.User_id2 AND f.User_id1 = :userId) OR (u.user_id = f.User_id1 AND f.User_id2 = :userId)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($result as &$row) {
                if (!empty($row['photo'])) {
                    $row['photo'] = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
                }
                else{
                    $default_image_path = "../IMG/user_male4-256.webp";
                    $row['photo'] = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($default_image_path));
                }
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($result);
        } catch (PDOException $e) {
            error_log('Database query error: ' . $e->getMessage());

            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid User ID']);
    }
}
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
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

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
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

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
                $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

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
            } else if ($users_count == 2) {
                $row['photo'] = $user_photo;
            } else {
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
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

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
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

    if (!empty($userId)) {
        $sql = "SELECT u.user_id, u.full_name, u.email, u.country, u.information, u.birthday, u.ban_status, u.photo 
                FROM User u
                JOIN Friends f ON (u.user_id = f.User_id2 AND f.User_id1 = ?) OR (u.user_id = f.User_id1 AND f.User_id2 = ?)";

        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ii", $userId, $userId);
            $stmt->execute();
            $result = $stmt->get_result();

            $friends = [];
            while ($row = $result->fetch_assoc()) {
                if (!empty($row['photo'])) {
                    $row['photo'] = 'data:image/jpeg;base64,' . base64_encode($row['photo']);
                } else {
                    $default_image_path = "../IMG/user_male4-256.webp";
                    $row['photo'] = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($default_image_path));
                }
                $friends[] = $row;
            }

            header('Content-Type: application/json; charset=utf-8');
            echo json_encode($friends);
        } catch (Exception $e) {
            error_log('Database query error: ' . $e->getMessage());

            http_response_code(500);
            echo json_encode(['error' => 'Internal Server Error']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid User ID']);
    }
}

else if (isset($_GET['action']) && $_GET['action'] === 'chenge_photo') {

    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

    if (isset($_GET['task'])) {

        if ($_GET['task'] == 'save') {

            if (isset($_FILES['img_upload']) && $_FILES['img_upload']['error'] === UPLOAD_ERR_OK) {

                $img_type = substr($_FILES['img_upload']['type'], 0, 5);
                $img_size = 1024 * 1024 * 10;

                if (!empty($_FILES['img_upload']['tmp_name']) && $img_type === 'image' && $_FILES['img_upload']['size'] < $img_size) {
                    $img_blob = file_get_contents($_FILES['img_upload']['tmp_name']);
                    $conn->query("UPDATE User SET photo = '" . addslashes($img_blob) . "' WHERE user_id = $userId");

                    echo json_encode([
                        'status' => 'success',
                        'photo' => 'data:image/jpeg;base64,' . base64_encode($img_blob)
                    ]);
                    exit;
                } else {
                    echo json_encode(['status' => 'error', 'message' => 'Invalid image type or size']);
                    exit;
                }
            } else {
                error_log('File upload error: ' . $_FILES['img_upload']['error']);
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Файл не загружен или произошла ошибка при загрузке'
                ]);
            }
        } elseif ($_GET['task'] == 'delete') {
            $conn->query("UPDATE User SET photo = NULL WHERE user_id = $userId");

            echo json_encode([
                'status' => 'success',
                'photo' => 'data:image/jpeg;base64,' . base64_encode(file_get_contents("../IMG/user_male4-256.webp"))
            ]);
            exit;
        }
    }
} 

else if (isset($_GET['action']) && $_GET['action'] === 'edit_data') {
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

    if (!empty($userId)) {
        $fullName = isset($_POST['full_name']) ? trim($_POST['full_name']) : '';
        $country = isset($_POST['country']) ? trim($_POST['country']) : '';
        $information = isset($_POST['information']) ? trim($_POST['information']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        try {
            $sql = "UPDATE User SET full_name = :full_name, country = :country, information = :information";

            if (!empty($password)) {
                $sql .= ", password = :password";
            }

            $sql .= " WHERE user_id = :user_id";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':full_name', $fullName, PDO::PARAM_STR);
            $stmt->bindParam(':country', $country, PDO::PARAM_STR);
            $stmt->bindParam(':information', $information, PDO::PARAM_STR);
            if (!empty($password)) {
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
            }
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update data.']);
            }
        } catch (PDOException $e) {
            error_log('Database query error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Internal Server Error']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid User ID']);
    }
}

else if (isset($_GET['action']) && $_GET['action'] === 'get_meetings') {
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

    if (isset($userId)) {
        try {
            $sql = "
            SELECT 
            u.photo AS organizer_photo,
            u.full_name AS organizer_name,
            u.country AS organizer_country,
            m.meeting_id,
            m.title,
            m.description,
            m.date_time AS date,
            m.duration,
            m.location,
            m.language_to_practice AS language,
            m.proficiency_level,
            IF(p.confirmed IS NOT NULL, p.confirmed, 0) AS confirmed
        FROM 
            Meetings m
        JOIN 
            User u ON m.organizer_id = u.user_id
        LEFT JOIN 
            Participants p ON m.meeting_id = p.meeting_id AND p.user_id = $userId
        WHERE 
            p.user_id = $userId OR m.organizer_id = $userId
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            $meetings = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($meetings as &$meeting) {
                if (!empty($meeting['organizer_photo'])) {
                    $meeting['organizer_photo'] = 'data:image/jpeg;base64,' . base64_encode($meeting['organizer_photo']);
                } else {
                    $default_image_path = "../IMG/user_male4-256.webp";
                    $meeting['organizer_photo'] = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($default_image_path));
                }
            }

            echo json_encode(['status' => 'success', 'meetings' => $meetings]);
        } catch (PDOException $e) {
            error_log('Database query error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid User ID']);
    }
} 


else if (isset($_GET['action']) && $_GET['action'] === 'confirm_participation') {
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);
    $meetingId = isset($_POST['meeting_id']) ? intval($_POST['meeting_id']) : 0;

    if ($userId && $meetingId) {
        try {
            $sql = "UPDATE Participants SET confirmed = 1 WHERE user_id = :user_id AND meeting_id = :meeting_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':meeting_id', $meetingId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update participation.']);
            }
        } catch (PDOException $e) {
            error_log('Database query error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Internal Server Error']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid User ID or Meeting ID']);
    }
}


else if (isset($_GET['action']) && $_GET['action'] === 'reject_participation') {
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);
    $meetingId = isset($_POST['meeting_id']) ? intval($_POST['meeting_id']) : 0;

    if ($userId && $meetingId) {
        try {
            $sql = "DELETE FROM Participants WHERE user_id = :user_id AND meeting_id = :meeting_id;";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':meeting_id', $meetingId, PDO::PARAM_INT);

            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update participation.']);
            }
        } catch (PDOException $e) {
            error_log('Database query error: ' . $e->getMessage());
            echo json_encode(['status' => 'error', 'message' => 'Internal Server Error']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid User ID or Meeting ID']);
    }
}
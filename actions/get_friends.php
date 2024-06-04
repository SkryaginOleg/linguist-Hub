<?php
require_once '../DataBase/db.php';
session_start();

if ($_GET['action'] == 'get_friends') {
    $userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);

    if ($userId) {
        $sql = "SELECT u.user_id, u.full_name, u.photo, u.country
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
                    $row['photo'] = '../IMG/user_male4-256.webp'; 
                }
                $friends[] = $row;
            }

            header('Content-Type: application/json');
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
?>

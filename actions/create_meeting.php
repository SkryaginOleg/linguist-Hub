<?php
require_once '../DataBase/db.php';
session_start();

$data = json_decode(file_get_contents('php://input'), true);

$userId = isset($_SESSION['user']) ? $_SESSION['user'] : intval($_COOKIE['user']);
$title = $data['title'];
$description = $data['description'];
$language_to_practice = $data['language_to_practice'];
$proficiency_level = $data['proficiency_level'];
$date_time = $data['date_time'];
$duration = $data['duration'];
$format = $data['format'];
$location = $data['location'];
$friends = $data['friends'];

$sql = "INSERT INTO Meetings (organizer_id, title, description, language_to_practice, proficiency_level, date_time, duration, format, location) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isssssiss", $userId, $title, $description, $language_to_practice, $proficiency_level, $date_time, $duration, $format, $location);
$stmt->execute();
$meetingId = $stmt->insert_id;

foreach ($friends as $friendId) {
    $sql = "INSERT INTO Participants (meeting_id, user_id, confirmed) VALUES (?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $meetingId, $friendId);
    $stmt->execute();
}

$sql = "INSERT INTO Participants (meeting_id, user_id, confirmed) VALUES (?, ?, 1)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $meetingId, $userId);
$stmt->execute();

echo json_encode(['status' => 'success']);
?>
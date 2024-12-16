<?php
include "../settings/connection.php";

session_start();

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'User must be logged in']);
    exit;
}

$data = json_decode(file_get_contents('php://input'), true);
$post_id = $data['post_id'];
$user_id = $_SESSION['user_id'];

// Check if user already liked the post
$stmt = $con->prepare("SELECT * FROM likes WHERE post_id = ? AND user_id = ?");
$stmt->bind_param("ii", $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Unlike the post
    $stmt = $con->prepare("DELETE FROM likes WHERE post_id = ? AND user_id = ?");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    $action = 'unliked';
} else {
    // Like the post
    $stmt = $con->prepare("INSERT INTO likes (post_id, user_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $post_id, $user_id);
    $stmt->execute();
    $action = 'liked';
}

// Get updated like count
$stmt = $con->prepare("SELECT COUNT(*) as count FROM likes WHERE post_id = ?");
$stmt->bind_param("i", $post_id);
$stmt->execute();
$count = $stmt->get_result()->fetch_assoc()['count'];

echo json_encode([
    'success' => true,
    'action' => $action,
    'likes' => $count
]);
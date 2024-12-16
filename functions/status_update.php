<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../settings/connection.php";

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pid']) && isset($data['status'])) {
    $post_id = $data['pid'];
    $status = $data['status'];
    
   
    if (!in_array($status, ['published', 'archived'])) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid status']);
        exit;
    }

    $db_status = ($status === 'published') ? 'archived' : 'published';
    
    $sql = "UPDATE Posts SET status = ? WHERE post_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "si", $db_status, $post_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing required parameters']);
}
?>
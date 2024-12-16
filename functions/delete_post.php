<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../settings/connection.php";

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['pid'])) {
    $post_id = $data['pid'];
    
    $sql = "DELETE FROM Posts WHERE post_id = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $post_id);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error']);
    }
    
    mysqli_stmt_close($stmt);
} else {
    echo "error";
}
?>
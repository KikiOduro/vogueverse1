<?php
require_once '../settings/connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    
    $query = "UPDATE posts SET title = ?, content = ? WHERE post_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("ssi", $title, $content, $post_id);
    
    if ($stmt->execute()) {
        header('Location: ../view/admin/manage_posts.php?message=Post updated successfully');
        exit();
    } else {
        header('Location: ../view/admin/edit_posts.php?pid=' . $post_id . '&error=Failed to update post');
        exit();
    }
  
}

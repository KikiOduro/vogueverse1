<?php
session_start();
require_once('../settings/connection.php');

// Check if user is logged in
// if (!isset($_SESSION['user_id'])) {
//     header('Location: ../login/login.php');
//     exit();
// }

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Get form data
    $post_id = mysqli_real_escape_string($con, $_POST['post_id']); 
    $user_id = $_SESSION['user_id'];
    $content = mysqli_real_escape_string($con, $_POST['comment']); 
    
    // Insert comment into database
    $sql = "INSERT INTO comments (post_id, user_id, comment_text, created_at) 
            VALUES ('$post_id', '$user_id', '$content', NOW())"; 
    if (mysqli_query($con, $sql)) {
        // Redirect back to post page
        header("Location: ../view/new_blog.php?postid=" . $post_id); // Fixed redirect path
        exit();
    } else {
        // Handles error
        echo "Error: " . mysqli_error($con);
    }
    
} else {
    // If not POST request, redirect to home
    header('Location: ../view/new_blog.php'); // Fixed redirect path
    exit();
}
?>
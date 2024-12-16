<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('../settings/connection.php');
require('../settings/core.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data and sanitize
    $title = htmlspecialchars(trim($_POST['title']));
    $content = htmlspecialchars(trim($_POST['content']));
    $image_path = null;

    // Handle image upload
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB
        
        $file = $_FILES['image'];
        
        // Validate file type and size
        if (!in_array($file['type'], $allowed_types)) {
            header("Location: ../view/admin/add_posts.php?error=invalid_file_type");
            exit();
        }
        
        if ($file['size'] > $max_size) {
            header("Location: ../view/admin/add_posts.php?error=file_too_large");
            exit();
        }
        
        // Generate unique filename
        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $unique_filename = uniqid() . '.' . $file_extension;
        
        // Specify upload directory
        $upload_dir = '../uploads/posts/';
        
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $upload_path = $upload_dir . $unique_filename;


        // var_dump(is_dir($upload_dir));
        // var_dump(move_uploaded_file($file['tmp_name'], $upload_path));
        // exit();
        
        // Move uploaded file
        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            $image_path = 'uploads/posts/' . $unique_filename;
        } else {
            header("Location: ../view/admin/add_posts.php?error=upload_failed");
            exit();
        }
    }

    $user_id = $_SESSION['user_id'];

    try {
        // Prepare SQL statement
        $query = "INSERT INTO posts (user_id, title, content, image_url) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($query);
        
        // Execute with parameters
        if ($stmt->execute([$user_id, $title, $content, $image_path])) {
            // Success - redirect with success message
            header("Location: ../view/admin/manage_posts.php?success=post_added");
            exit();
        } else {
            // Database error
            header("Location: ../view/admin/add_posts.php?error=database_error");
            exit();
        }
        
    } catch(PDOException $e) {
        // Log error (in production, use proper error logging)
        error_log("Error adding post: " . $e->getMessage());
        header("Location: ../view/admin/add_posts.php?error=database_error");
        exit();
    }
} else {
    // Invalid request
    header("Location: ../view/admin/add_posts.php?error=invalid_request");
    exit();
}
?>

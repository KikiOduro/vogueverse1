<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require('../settings/connection.php');
require('../settings/core.php');

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Debug information
error_log("POST data: " . print_r($_POST, true));
error_log("FILES data: " . print_r($_FILES, true));
error_log("SESSION data: " . print_r($_SESSION, true));

// Check if form was submitted
if (!isset($_POST['submit'])) {
    error_log("Form submit button not found");
    header("Location: ../view/admin/add_posts.php?error=no_submit");
    exit();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    error_log("No user_id in session");
    header("Location: ../view/admin/add_posts.php?error=not_logged_in");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Get form data and sanitize
    $title = mysqli_real_escape_string($con, $_POST['title']);
    $content = mysqli_real_escape_string($con, $_POST['content']);
    $image_path = null;
    $user_id = $_SESSION['user_id'];

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $max_size = 5 * 1024 * 1024; // 5MB

        $file = $_FILES['image'];

        if (!in_array($file['type'], $allowed_types)) {
            header("Location: ../view/admin/add_posts.php?error=invalid_file_type");
            exit();
        }

        if ($file['size'] > $max_size) {
            header("Location: ../view/admin/add_posts.php?error=file_too_large");
            exit();
        }

        // Create uploads directory if it doesn't exist
        $upload_dir = dirname(__FILE__) . '/../uploads/posts/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }

        $file_extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $unique_filename = uniqid() . '.' . $file_extension;
        $upload_path = $upload_dir . $unique_filename;

        if (move_uploaded_file($file['tmp_name'], $upload_path)) {
            $image_path = 'uploads/posts/' . $unique_filename;
        } else {
            error_log("Upload failed. Error: " . error_get_last()['message']);
            header("Location: ../view/admin/add_posts.php?error=upload_failed");
            exit();
        }
    }

    // Insert into database using mysqli
    $stmt = $con->prepare("INSERT INTO Posts (user_id, title, content, image_url) VALUES (?, ?, ?, ?)");
    if (!$stmt) {
        error_log("Prepare failed: " . $con->error);
        header("Location: ../view/admin/add_posts.php?error=prepare_failed");
        exit();
    }

    $stmt->bind_param("isss", $user_id, $title, $content, $image_path);

    if ($stmt->execute()) {
        header("Location: ../view/admin/manage_posts.php?success=post_added");
        exit();
    } else {
        error_log("Execute failed: " . $stmt->error);
        header("Location: ../view/admin/add_posts.php?error=database_error");
        exit();
    }
} else {
    header("Location: ../view/admin/add_posts.php?error=invalid_request");
    exit();
}

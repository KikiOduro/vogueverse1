<?php
require_once '../../settings/connection.php';
require('../../functions/get_username.php');

if (!isset($_GET['pid'])) {
    header('Location: home.php');
    exit();
}

$post_id = $_GET['pid'];
$query = "SELECT * FROM posts WHERE post_id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

if (!$post) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Post</title>
    <link rel="stylesheet" href="../../layout/styles/adminstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: bold;
            color: #333;
        }

        .form-group input[type="text"],
        .form-group textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 4px;
            transition: border-color 0.3s;
        }

        .form-group input[type="text"]:focus,
        .form-group textarea:focus {
            border-color: #4CAF50;
        }

        .submit-btn {
            background-color: #4CAF50;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .submit-btn:hover {
            background-color: #45a049;
        }

        .cancel-btn {
            background-color: #f44336;
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 1rem;
            transition: background-color 0.3s;
        }

        .cancel-btn:hover {
            background-color: #e53935;
        }

        .form-group input[type="file"] {
            padding: 0.5rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar flex flex-column justify-between">
            <h3>Post Management System</h3>

            <div class="flex flex-column justify-between h-full">
                <!-- menu links -->
                <div class="menu-links flex flex-column">
                    <div class="flex items-center gap-4">
                        <img src="../../images/icons/material-symbols_dashboard.svg" alt="">
                        <a href="home.php">Home</a>
                    </div>
                    <div class="flex items-center gap-4 active">
                        <img src="../../images/icons/clarity_tasks-line.svg" alt="">
                        <a href="manage_posts.php">Post Management</a>
                    </div>
                    <div class="flex items-center gap-4">
                        <img src="../../images/icons/clarity_tasks-line.svg" alt="">
                        <a href="post_assignments.php">Post Assignments</a>
                    </div>
                </div>

                <div class="flex items-center gap-4">
                    <img src="../../images/icons/clarity_tasks-line.svg" alt="">
                    <a href="../actions/logout.php">Logout</a>
                </div>
            </div>
        </aside>

        <div class="content">
            <header class="flex items-center justify-between">
                <h2>Edit Post</h2>
                <p><?php echo getUserName() ?></p>
            </header>

            <div class="inner flex flex-column gap-8">
                <form action="../../functions/update_post.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="post_id" value="<?php echo $post['post_id']; ?>">
                    <div class="flex flex-column gap-4">
                        <div class="form-group">
                            <label for="title">Post Title</label>
                            <input type="text" name="title" id="title" class="w-full" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="content">Post Content</label>
                            <textarea name="content" id="content" rows="10" class="w-full" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">Post Image</label>
                            <input type="file" name="image" id="image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <button type="submit" name="submit" class="submit-btn">Update Post</button>
                            <a href="manage_posts.php" class="cancel-btn">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>


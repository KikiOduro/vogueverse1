<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VogueVerse - Fashion Blog</title>
    <link rel="stylesheet" href="../layout/styles/blogstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --accent-color: #e74c3c;
            --text-color: #333;
            --light-gray: #f5f6fa;
            --white: #ffffff;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--light-gray);
        }

        .header {
            background-color: var(--white);
            padding: 2rem 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .header h1 {
            text-align: center;
            color: var(--primary-color);
            font-size: 2.5rem;
            font-weight: 700;
            letter-spacing: 2px;
        }

        .main-container {
            max-width: 1200px;
            margin: 2rem auto;
            padding: 0 20px;
            display: grid;
            grid-template-columns: 7fr 3fr;
            gap: 2rem;
        }

        .blog-posts {
            display: grid;
            gap: 2rem;
        }

        .post-card {
            background: var(--white);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .post-image {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .post-content {
            padding: 2rem;
        }

        .post-meta {
            display: flex;
            gap: 1rem;
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .post-title {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .post-title a {
            text-decoration: none;
            color: inherit;
        }

        .post-text {
            color: #555;
            margin-bottom: 1.5rem;
        }

        .read-more {
            display: inline-block;
            color: var(--accent-color);
            text-decoration: none;
            font-weight: 600;
            margin-top: 1rem;
        }

        .like-button {
            background: transparent;
            border: 2px solid var(--accent-color);
            color: var(--accent-color);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .like-button:hover {
            background: var(--accent-color);
            color: var(--white);
        }

        .sidebar {
            background: var(--white);
            border-radius: 12px;
            padding: 2rem;
            position: sticky;
            top: 100px;
            height: fit-content;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .sidebar-title {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .footer {
            background: var(--primary-color);
            color: var(--white);
            padding: 3rem 0;
            text-align: center;
            margin-top: 4rem;
        }

        .social-links {
            margin: 1.5rem 0;
        }

        .social-links a {
            color: var(--white);
            margin: 0 1rem;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: var(--accent-color);
        }

        @media (max-width: 768px) {
            .main-container {
                grid-template-columns: 1fr;
            }

            .sidebar {
                position: static;
            }

            .post-image {
                height: 200px;
            }

            .header h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <h1>VogueVerse</h1>
    </header>

    <div class="main-container">
        <main class="blog-posts">
            <?php
            require_once('../settings/connection.php');
            
            if (isset($_GET['postid'])) {
                // Single post display
                $postid = mysqli_real_escape_string($con, $_GET['postid']);
                $query = "SELECT p.*, u.fname, u.lname
                         FROM Posts p 
                         LEFT JOIN Users u ON p.user_id = u.user_id 
                         WHERE p.post_id = '$postid'";
                $result = mysqli_query($con, $query);
                
                if ($post = mysqli_fetch_assoc($result)) {
                    ?>
                    <article class="post-card">
                        <?php if ($post['image_url']): ?>
                            <img src="<?php echo htmlspecialchars("../" . $post['image_url']); ?>" alt="Post Image" class="post-image">
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <div class="post-meta">
                                <span><i class="far fa-calendar"></i> <?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                                <span><i class="far fa-user"></i> <?php echo htmlspecialchars($post['fname'].' '. $post['lname'] ?? 'Anonymous'); ?></span>
                            </div>
                            <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                            <div class="post-text">
                                <?php echo nl2br(htmlspecialchars($post['content'])); ?>
                            </div>
                            <button onclick="likePost(<?php echo $post['post_id']; ?>)" class="like-button">
                                <i class="far fa-heart"></i> Like
                            </button>
                        </div>
                    </article>
                    <?php
                }
            } else {
                // All posts display
                $query = "SELECT p.*, u.fname 
                         FROM Posts p 
                         LEFT JOIN Users u ON p.user_id = u.user_id 
                         ORDER BY created_at DESC";
                $result = mysqli_query($con, $query);
                
                while ($post = mysqli_fetch_assoc($result)) {
                    ?>
                    <article class="post-card">
                        <?php if ($post['image_url']): ?>
                            <img src="<?php echo htmlspecialchars("../" . $post['image_url']); ?>" alt="Post Image" class="post-image">
                        <?php endif; ?>
                        
                        <div class="post-content">
                            <div class="post-meta">
                                <span><i class="far fa-calendar"></i> <?php echo date('M d, Y', strtotime($post['created_at'])); ?></span>
                                <span><i class="far fa-user"></i> <?php echo htmlspecialchars($post['fname'] ?? 'Anonymous'); ?></span>
                            </div>
                            <h2 class="post-title">
                                <a href="?postid=<?php echo $post['post_id']; ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </a>
                            </h2>
                            <div class="post-text">
                                <?php echo nl2br(htmlspecialchars(substr($post['content'], 0, 200))); ?>...
                                <a href="?postid=<?php echo $post['post_id']; ?>" class="read-more">Read More →</a>
                            </div>
                            <button onclick="likePost(<?php echo $post['post_id']; ?>)" class="like-button">
                                <i class="far fa-heart"></i> Like
                            </button>
                        </div>
                    </article>
                    <?php
                }
            }
            ?>
        </main>

        <aside class="sidebar">
            <h3 class="sidebar-title">About VogueVerse</h3>
            <p>Your premier destination for fashion insights, trends, and style inspiration. Join us in exploring the latest in fashion and personal style.</p>
        </aside>
    </div>

    <footer class="footer">
        <h2>VogueVerse</h2>
        <div class="social-links">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-pinterest"></i></a>
        </div>
        <p>Empowering Style, Inspiring Confidence, One Thread at a Time.</p>
    </footer>

    <script>
        function likePost(postId) {
            fetch(`../includes/like_post.php?postid=${postId}`, {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('You liked this post!');
                } else {
                    alert('Error liking post');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error liking post');
            });
        }
    </script>
</body>
</html>

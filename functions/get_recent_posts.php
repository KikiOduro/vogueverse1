<?php
include "../../settings/connection.php";

$con; // DB Connection 

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
function getRecentPosts()
{
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT 
        p.post_id, 
        p.user_id, 
        p.title, 
        p.content, 
        p.created_at
    FROM 
        Posts p
    WHERE 
        p.user_id = '$user_id'
    ORDER BY 
        p.created_at DESC
    LIMIT 5;";

    global $con;

    $results = mysqli_query($con, $sql);

    if (mysqli_num_rows($results) > 0) {
        $posts = mysqli_fetch_all($results, MYSQLI_ASSOC);

        foreach ($posts as $post) {
            echo '<div class="post_card flex gap-5 items-center justify-between">
      <div class="flex gap-4">

          <div class="flex flex-column gap-2">
              <h2 class="font-medium">' . htmlspecialchars($post['title']) . '</h2>
              <p class="text-sm">' . htmlspecialchars($post['content']) . '</p>
          </div>
      </div>

      <div class="flex items-center gap-2">
          <div class="icon">
              <img src="../assets/icons/iconamoon_calendar-1-light.svg" alt="">
          </div>
          <p class="date_post text-sm">Date created: ' . htmlspecialchars($post['created_at']) . '</p>
      </div>

      <a href="post_details.php?post_id=' . htmlspecialchars($post['post_id']) . '" class="text-sm">View Post</a>
  </div>';
        }
    } else {
        echo "<p>No recent posts found.</p>";
    }
}

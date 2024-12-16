<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "../../settings/connection.php";

$con; // DB Connection 


function getPosts()
{
  $sql = "SELECT * FROM Posts";
  global $con;

  $results = mysqli_query($con, $sql);

  if (mysqli_num_rows($results) > 0) {
    $posts = mysqli_fetch_all($results, MYSQLI_ASSOC);

    foreach ($posts as $post) {
      $icon = ($post['status'] == "published" ? "eyeopen.svg" : 
              ($post['status'] == "archived" ? "eyeclose.svg" : "eyeopen.svg"));
      
      echo "<tr>
        <td>" . $post['title'] . "</td>
        <td class='actions'>
                        <a href='javascript:void(0)' id='status_post' data-pid=" . $post['post_id'] . " data-status='" . $post['status'] . "' class='status_post'>
                            <img src='../../images/icons/" . $icon . "' alt=''>
                        </a>

            <a href='../admin/edit_posts.php?pid=" . $post['post_id'] . "' id='edit_post' data-pid=" . $post['post_id'] . " class='edit_post'><img src='../../images/icons/iconamoon_edit-thin.svg' alt='' ></a>
            <a href='javascript:void(0)' id='del_post' data-pid=" . $post['post_id'] . " class='del_post'><img src='../../images/icons/material-symbols-light_delete-outline.svg' alt=''></a>
        </td>
    </tr>";
    }
  } else {
    echo "<tr>
          <td> No Posts Added.</td>
          <td></td>
      </tr>";
  }
}

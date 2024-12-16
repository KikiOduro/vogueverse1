<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  
require_once "../../settings/connection.php";

$con; // DB Connection 

function getStatistics()
{
    global $con;
    $user_id =$_SESSION["user_id"];
    $sql = "SELECT * FROM `Posts` WHERE user_id = '$user_id'";

    $results = mysqli_query($con, $sql);

    $num_posts= mysqli_num_rows($results);

    echo '<div class=" flex items-center justify-between gap-6">
  <div class="card flex flex-column gap-5">
      <div class="flex items-center gap-4">
          <!-- icon -->
          <div class="icon">
              <img src="../assets/icons/mdi_account-pending-outline.svg" alt="">
          </div>
          <p>All Posts</p>
      </div>
      <h1 class="progress">' . $num_posts . '</h1>
  </div>
  
</div>';
}

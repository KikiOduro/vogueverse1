<?php
include "../settings/connection.php";

$con; // DB Connection 

function getStatus($sid = NULL)
{
  global $con;

  $sql = "SELECT * FROM Status";
  $results = mysqli_query($con, $sql);

  if (mysqli_num_rows($results) > 0) {
    $options = '';

    while ($status = mysqli_fetch_assoc($results)) {
      $selected = ($sid == $status['sid']) ? ' selected' : '';
      $options .= '<option value="' . $status['sid'] . '"' . $selected . '>' . $status['sname'] . '</option>';
    }

    echo $options;
  }
}

<?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}

function getUserName(){
  return $_SESSION['fname'] . ' '. $_SESSION['lname'];
}
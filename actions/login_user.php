<?php
session_start();
include "../settings/connection.php";

// * Handle Login of users
if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // * Validate login details
    if (empty($email) || empty($password) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('Location: ../login/login.php?msg=error');
        exit;
    }

    $sql = "SELECT * FROM Users WHERE email = '$email'";
    $results = mysqli_query($con, $sql);

    if (mysqli_num_rows($results) > 0) {
        $data = mysqli_fetch_assoc($results);

        // Match password
        if (password_verify($password, $data['password'])) { // Change 'password' if column name differs
            // Creating a session for the user
            $_SESSION['user_id'] = $data['user_id'];
            $_SESSION['fname'] = $data['fname'];
            $_SESSION['lname'] = $data['lname'];

            header('Location: ../view/admin/home.php?msg=success');
                exit;
        } else {
            header('Location: ../login/login.php?msg=usernotfound');
            exit;
        }
    } else {
        header('Location: ../login/login.php?msg=usernotfound');
        exit;
   

    }
  }
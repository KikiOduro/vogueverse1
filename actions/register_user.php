<?php
include "../settings/connection.php";

if (isset($_POST['register'])) {
    // Validate and sanitize inputs
    $fname = isset($_POST['fname']) ? mysqli_real_escape_string($con, $_POST['fname']) : '';
    $lname = isset($_POST['lname']) ? mysqli_real_escape_string($con, $_POST['lname']) : '';
    $gender = isset($_POST['gender']) ? mysqli_real_escape_string($con, $_POST['gender']) : '';
    $role = isset($_POST['role']) ? mysqli_real_escape_string($con, $_POST['role']) : '';
    $dob = isset($_POST['dob']) ? mysqli_real_escape_string($con, $_POST['dob']) : '';
    $phone = isset($_POST['phone']) ? mysqli_real_escape_string($con, $_POST['phone']) : '';
    $email = isset($_POST['email']) ? mysqli_real_escape_string($con, $_POST['email']) : '';
    $password = isset($_POST['password']) ? mysqli_real_escape_string($con, $_POST['password']) : '';

    // Hash the password
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    // Query to insert into Users table
    $people_sql = "INSERT INTO Users(fname, lname, gender, dob, phone, email, password) 
                   VALUES ('$fname', '$lname', '$gender', '$dob', '$phone', '$email', '$hash_password')";

    if (mysqli_query($con, $people_sql)) {
        header('Location: ../login/register.php?msg=success');
    } else {
        header('Location: ../login/register.php?msg=error');
    }
}
?>

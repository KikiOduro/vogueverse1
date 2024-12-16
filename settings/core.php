<?php
//start session
session_start();

//include "connection.php";

// * check for login 
function core_check_login()
{
	//check if login session exit
	if (!isset($_SESSION['user_id'])) {
		//redirect to login page
		header('Location: ../login/login.php');

		//to stop the rest of the code from executing
		exit();
	}
}


// * get user id
function core_get_user_id()
{
	//get session id
	if (isset($_SESSION['user_id'])) {

		//return user id
		return $_SESSION['user_id'];
	}
}


// * get user role
function core_get_role()
{
	//get session role
	if (isset($_SESSION['user_role'])) {
		//return user role
		return $_SESSION['user_role'];
	}

	return NULL;
}
?>
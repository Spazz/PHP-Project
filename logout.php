<?php # Script 11.6 - logout.php

// This page lets the user logout.
require_once ('includes/login_functions.php');
// If no cookie is present, redirect the user:
if (!isset($_COOKIE['email'])) {

	// Need the functions to create an absolute URL:
	$url = absolute_url();
	header("Location: $url");
	exit(); // Quit the script.
	
} else { // Delete the cookies.
	setcookie ('user_id', '', time()-3600, '/', '', 0, 0);
	setcookie ('email', '', time()-3600, '/', '', 0, 0);
	setcookie ('pass', '', time()-3600, '/', '', 0, 0);
	setcookie ('first_name', '', time()-3600, '/', '', 0, 0);
	setcookie ('last_name', '', time()-3600, '/', '', 0, 0);
	$url = absolute_url();
	header("Location: index.php");
		exit();
	}
?>
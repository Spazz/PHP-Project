<?php #Login functions

if (isset($_POST['submitted'])) {
	require_once ('includes/login_functions.php');
	require_once ('mysqli_connect.php');
	list ($check, $data) = check_login($dbc, $_POST['email'], $_POST['pass']);
	
	if ($check) { // OK!
		// Set the cookies:
		setcookie ('user_id', $data['user_id'], time()+3600, '/', '', 0, 0);
		setcookie ('email', $data['email'], time()+3600, '/', '', 0, 0);
		setcookie ('pass', $data['pass'], time()+3600, '/', '', 0, 0);
		setcookie ('first_name', $data['first_name'], time()+3600, '/', '', 0, 0);
		setcookie ('last_name', $data['last_name'], time()+3600, '/', '', 0, 0);		
		
		// Redirect:
		$url = absolute_url ('index.php');
		header("Location: $url");
		exit(); 
			
	} else { // Unsuccessful!
		include ('includes/top.php');
		echo '<meta http-equiv="refresh" content="3; url=index.php">';
		echo '<h1>Error!</h1>
	<p class="error">The following error(s) occurred:<br />';
	foreach ($data as $msg) {
		echo " - $msg<br />\n";
	}
	echo '</p><p>Please try again.</p>';
		include ('includes/bottom.php');
	}
		
	mysqli_close($dbc);

} // End of the main submit conditional.

//include ('includes/login_page.php');
?>

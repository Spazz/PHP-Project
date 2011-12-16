<link href="../css/styles.css" rel="stylesheet" type="text/css" media="all" />

<?php if (isset($_COOKIE['email'])) {
	$first = $_COOKIE['first_name'];
	$first = ucwords($first);
	$last = $_COOKIE['last_name'];
	$last = ucwords($last);
	// Print a customized message:
	echo '<form action="logout.php" method="post" class="login">';
	echo "<label class=\"name\">Welcome $first $last!&nbsp &nbsp &nbsp &nbsp</label>";
	echo "<input type=\"button\" onClick=\"window.location='view_cart.php'\" value=\"View Cart\" name=\"View_Cart\" class=\"btn\" />";
	echo "<input type=\"button\" onClick=\"window.location='view_history.php'\" value=\"History\" name=\"Register\" class=\"btn\" />";
	echo '<input name="logout" type="submit" class="btn" value="Logout" />
	</form>';
		} else {
		
	echo '<form action="login.php" method="post" class="login">
    <input name="email" type="text" class="txt" placeholder="Email" />
    
	<input name="pass" type="password" class="txt" placeholder="Password" />
    <input type="submit" value="Login" name="Login" class="btn" />';
	echo "<input type=\"button\" onClick=\"window.location='register.php'\" value=\"Register\" name=\"Register\" class=\"btn\" />";
	echo '<input type="hidden" name="submitted" value="TRUE"/>
	</form>';
	}
?>
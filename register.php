<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
$page_title = 'Register';
// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	require_once ('./mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			include ('includes/top.php');
			echo '<meta http-equiv="refresh" content="3; url=index.php">';
			echo '<div align="center"><h2>Thank you!</h2>
			<p>You are now registered and are able to log in, You will be redirect to the main page in 5 seconds...</p><p><br /></p></div>';	
			include ('includes/bottom.php');
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.
include ('includes/footer.html');
} // End of the main Submit conditional.
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sportsman's Paradise | Registration</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="head">
 <div id="head_cen">
  <div id="head_sup" class="head_pad">
   </p>
    <h1 class="logo"><a href="index.php"></a></h1>
    <ul>
     <li><a href="index.php">Home</a></li>
     <li><a href="about.php">About</a></li>
     <li><a href="products.php">Products</a></li>
     <li><a href="contact.php">Contact</a></li>
   </ul>
  </div>
 </div>
</div>
<div id="content">
 <div id="content_cen">
  <div id="content_sup" class="head_pad">
   <div id="register">
    <h2><span>Registration</span></h2><br /><br /><br />
	<div class="rgtWrap">
	<form action="register.php" class="login" method="post">
	<ul>
		<li>First Name:</li> <li><input type="text"  name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></li>
		<li>Last Name:</li> <li><input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></li>
		<li>Email Address:</li> <li><input type="text" name="email" size="20" maxlength="80" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /></li>
		<li>Password:</li> <li><input type="password" name="pass1" size="10" maxlength="20" /></li>
		<li>Confirm Password:</li> <li><input type="password" name="pass2" size="10" maxlength="20" /></li>
	</ul>
		<input type="submit" name="submit" class="btn" value="Register" />
		<input type="reset" name="reset" class="btn" value="Reset" />
		<input type="hidden" name="submitted" value="TRUE" />
	</form>
	</div>
   </div>   
  </div>
 </div>
</div>
<?php include('includes/footer.html');?>
</body>
</html>

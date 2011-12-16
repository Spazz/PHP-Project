<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<div id="head">
 <div id="head_cen">
  <div id="head_sup" class="head_pad">
  <?php if (isset($_COOKIE['email'])) {
	$first = $_COOKIE['first_name'];
	$first = ucwords($first);
	$last = $_COOKIE['last_name'];
	$last = ucwords($last);
	// Print a customized message:
	echo '<form action="logout.php" method="post" class="login">';
	echo "<label>Welcome $first $last!&nbsp &nbsp &nbsp &nbsp</label>";
	echo "<input type=\"button\" onClick=\"window.location='view_cart.php'\" value=\"View Cart\" name=\"View_Cart\" class=\"btn\" />";
	echo "<input type=\"button\" onClick=\"window.location='view_history.php'\" value=\"History\" name=\"Register\" class=\"btn\" />";
	echo '<input name="logout" type="submit" class="btn" value="Logout" />
	</form>';
		} else {
	echo '<form action="login.php" method="post" class="login"><label>EMAIL</label>
    <input name="email" type="text" class="txt" />
    <label>PASSWORD</label>
	<input name="pass" type="password" class="txt" />
    <input type="submit" value="Login" name="Login" class="btn" />';
	echo "<input type=\"button\" onClick=\"window.location='register.php'\" value=\"Register\" name=\"Register\" class=\"btn\" />";
	echo '<input type="hidden" name="submitted" value="TRUE"/>
	</form>';
	}
	?>
   
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
   <div id="welcome_pan">

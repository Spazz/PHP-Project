<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sportsman's Paradise</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
</head>

<body>
<div id="head">
 <div id="head_cen">
  <div id="head_sup" class="head_pad">
  <?php if (isset($_COOKIE['email'])) {
	// Print a customized message:
	echo '<form action="logout.php" method="post" class="login">';
	echo "<label>Welcome {$_COOKIE['first_name']} {$_COOKIE['last_name']}!&nbsp &nbsp &nbsp &nbsp</label>";
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
    <h1 class="logo"><a href="../index.php"></a></h1>
    <ul>
     <li><a href="index.php">Home</a></li>
     <li><a href="about.php">About</a></li>
     <li><a class="active" href="products.php">Products</a></li>
     <li><a href="contact.php">Contact</a></li>
   </ul>
  </div>
 </div>
</div>
<div id="content">
 <div id="content_cen">
  <div id="content_sup" class="head_pad">
   <div id="welcom_pan">
<?php
// This page displays the available prints (products).
$product =$_GET['cat'];
// Set the page title and include the HTML header:
$page_title = 'Browse the Products';

require_once ('mysqli_connect.php');

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(product_id) FROM products WHERE category='$product'";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'pn';

// Determine the sorting order:
switch ($sort) {
	case 'pn':
		$order_by = 'product_name ASC';
		break;
	case 'price':
		$order_by = 'price ASC';
		break;
	case 'size':
		$order_by = 'size ASC';
		break;
	default:
		$order_by = 'product_name ASC';
		$sort = 'pn';
		break;
}
// Default query for this page:
$q = "SELECT * FROM products WHERE category = '$product' ORDER BY $order_by LIMIT $start, $display";

// Create the table head:
echo "<h2 first-letter:UPPERCASE><span></span>$product</h2><br /><br /><br />";
echo '<table border="0" width="90%" cellspacing="3" cellpadding="3" align="right">
	<tr>
		<td align="left" width="20%"><b>Add to Cart</b></td>
		<td align="left"><b><a href="items.php?cat='. $product .'&sort=pn">Product</a></b></td>
		<td align="left"><b><a href="items.php?cat='. $product .'&sort=size">Size</a></b></td>
		<td align="right"><b><a href="items.php?cat='. $product .'&sort=price">Price</a></b></td>
	</tr>';

// Display all the prints, linked to URLs:
$r = mysqli_query ($dbc, $q);
while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
	//display each product
	echo '<tr bgcolor="' . $bg . '">
		<td align="left"><a href="add_cart.php?pid='.$row['product_id'] .'">Add to Cart</td>
		<td align="left">'. $row['product_name'] .'</td>
		<td align="left"><select>
  			<option value="size">Small</option>
  			<option value="size">Medium</option>
  			<option value="size">Large</option>
			</select></td>
		<td align="right">$'. $row['price'] .'</td>
	</tr>';

} // End of while loop.

echo '</table>';
mysqli_close($dbc);

// Make the links to other pages, if necessary.
if ($pages > 1) {
	
	echo '<br /><p>';
	$current_page = ($start/$display) + 1;
	
	// If it's not the first page, make a Previous button:
	if ($current_page != 1) {
		echo '<a href="items.php?cat='. $product .'&s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
	}
	
	// Make all the numbered pages:
	for ($i = 1; $i <= $pages; $i++) {
		if ($i != $current_page) {
			echo '<a href="items.php?cat='. $product .'&s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
		} else {
			echo $i . ' ';
		}
	} // End of FOR loop.
	
	// If it's not the last page, make a Next button:
	if ($current_page != $pages) {
		echo '<a href="items.php?cat='. $product .'&s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
	}
	
	echo '</p>'; // Close the paragraph.
	
} // End of links section.
?>
    </div>   
  </div>
 </div>
</div>
</body>
<div id="foot">
 <div id="foot_cen">
 <h6><a href="index.html"></a></h6>
	<ul>
     <li><a href="index.php">Home</a></li>
     <li class="space">|</li>
     <li><a href="about.php">About</a></li>
     <li class="space">|</li>
     <li><a href="products.php">Products</a></li>
     <li class="space">|</li>
     <li><a href="contact.php">Contact</a></li>
	 <li class="space">|</li>
     <li><a href="contact.php">Careers</a></li>
	</ul>
    <p>� Sportsmen Paradise created by B.B.C.N. Template designed by: <a href="http://www.templateworld.com" target="_blank">Template World</a></p>
 </div>
</div>
</html>
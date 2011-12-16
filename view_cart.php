<?php
// This page displays the contents of the shopping cart.
// This page also lets the user update the contents of the cart.
session_start();
include ('includes/top.php');
// Set the page title and include the HTML header:
$page_title = 'View Your Shopping Cart';
// Check if the form has been submitted (to update the cart):
if (isset($_POST['submitted'])) {

	// Change any quantities:
	foreach ($_POST['qty'] as $k => $v) {

		// Must be integers!
		$pid = (int) $k;
		$qty = (int) $v;
		
		if ( $qty == 0 ) { // Delete.
			unset ($_SESSION['cart'][$pid]);
		} elseif ( $qty > 0 ) { // Change quantity.
			$_SESSION['cart'][$pid]['quantity'] = $qty;
		}
		
	}  //End of FOREACH.
}

// Display the cart if it's not empty...
if (!empty($_SESSION['cart'])) {

	// Retrieve all of the information for the prints in the cart:
	require_once ('mysqli_connect.php');
	$q = "SELECT * FROM products WHERE products.product_id IN (";
	foreach ($_SESSION['cart'] as $pid => $value) {
		$q .= $pid . ',';
	}
	$q = substr($q, 0, -1) . ') ORDER BY products.price ASC';
	$r = mysqli_query ($dbc, $q);
	//echo "$q";
	//exit();
	
	// Create a form and a table:
	echo '<form action="view_cart.php" method="post">
<table border="0" width="90%" cellspacing="3" cellpadding="3" align="center">
	<tr>
		<td align="left" width="40%"><b>Product Name</b></td>
		<td align="left" width="20%"><b>Size</b></td>
		<td align="left" width="10%"><b>Quantity</b></td>
		<td align="center" width="10%"><b>Price</b></td>
		<td align="right" width="10%"><b>Total Price</b></td>
	</tr>
';
	// Print each item...
	$total = 0; // Total cost of the order.
	while ($row = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
		
		// Calculate the total and sub-totals.
		$subtotal = $_SESSION['cart'][$row['product_id']]['quantity'] * $_SESSION['cart'][$row['product_id']]['price'];
		$total += $subtotal;
		
		// Print the row.
		echo '<tr>
		<td align="left">'. $row['product_name'] .'</td>
		<td align="left">'. $_GET['size'] .'</td>
		<td align="left"><input type="text" size="3" name="qty['. $row['product_id'] .']" value="'. $_SESSION['cart'][$row['product_id']]['quantity'] .'" /></td>
		<td align="right">$'. $_SESSION['cart'][$row['product_id']]['price'] .'</td>
		<td align="right">$' . number_format ($subtotal, 2) . '</td>
	</tr>';
	
	} // End of the WHILE loop.
	$_SESSION['total'] = $total;
	mysqli_close($dbc); // Close the database connection.

	// Print the footer, close the table, and the form.
	echo '<tr>
		<td colspan="4" align="right"><b>Total:</b></td>
		<td align="right">$' . number_format ($total, 2) . '</td>
	</tr>
	</table>
	<div align="center"><input type="submit" name="submit" value="Update My Cart" /></div>
	<input type="hidden" name="submitted" value="TRUE" />
	</form><p align="center">Enter a quantity of 0 to remove an item.
	<br /><br /><a href="checkout.php">Checkout</a></p>';

} else {
	echo '<p>Your cart is currently empty.</p>';
} include ('includes/bottom.php');
?>

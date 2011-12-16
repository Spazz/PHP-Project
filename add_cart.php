<?php
session_start();
include ('includes/header.php');
// Set the page title and include the HTML header:
$page_title = 'Add to Cart';

if (isset ($_GET['pid']) && is_numeric($_GET['pid']) ) { // Check for a product ID.

	$pid = (int) $_GET['pid'];
	$size = $_GET['size'];

	// Check if the cart already contains one of these prints;
	// If so, increment the quantity:
	if (isset($_SESSION['cart'][$pid])) {
	
		$_SESSION['cart'][$pid]['quantity']++; // Add another.

		// Display a message.
		echo '<div align="center"><font color="#31a1ff">Another copy of the product has been added to your shopping cart.</font></div>';
		
	} else { // New product to the cart.

		// Get the product's price from the database:
		require_once ('mysqli_connect.php');
		$q = "SELECT price FROM products WHERE products.product_id = $pid";
		$r = mysqli_query ($dbc, $q);		
		if (mysqli_num_rows($r) == 1) { // Valid product ID.
		
			// Fetch the information.
			list($price) = mysqli_fetch_array ($r, MYSQLI_NUM);
			
			// Add to the cart:
			$_SESSION['cart'][$pid] = array ('quantity' => 1, 'price' => $price);

			// Display a message:
			echo '<div align="center"><font color="#31a1ff">The product has been added to your shopping cart.</font></div>';

		} else { // Not a valid prodct ID.
			echo '<div align="center"><font color="#31a1ff">This page has been accessed in error!</font></div>';
		}
		
		mysqli_close($dbc);

	} // End of isset($_SESSION['cart'][$pid] conditional.

} else { // No product ID.
	echo '<div align="center"><font color="#31a1ff">This page has been accessed in error!</font></div>';
	
}
include ('includes/footer.html');
?>

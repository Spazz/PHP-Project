<?php 
// This page inserts the order information into the table.
// This page would come after the billing process.
// This page assumes that the billing process worked (the money has been taken).

// Set the page title and include the HTML header.
$page_title = 'Order Confirmation';
session_start();
include ('includes/top.php');

// Checks to see if the user is logged in.
if (isset($_COOKIE['email'])){

	$customer = $_COOKIE['user_id'];
	$total = $_SESSION['total'];

// Assume that this page receives the order total.
require_once ('mysqli_connect.php'); // Connect to the database.

// Turn autocommit off.
mysqli_autocommit($dbc, FALSE);

// Add the order to the orders table...
$q = "INSERT INTO orders (user_id, total) VALUES ($customer, $total)";
$r = mysqli_query($dbc, $q);
if (mysqli_affected_rows($dbc) == 1) {

	// Need the order ID:
	$oid = mysqli_insert_id($dbc);
	
	// Insert the specific order contents into the database...
	
	// Prepare the query:
	$q = "INSERT INTO order_contents (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
	$stmt = mysqli_prepare($dbc, $q);

	mysqli_stmt_bind_param($stmt, 'iiid', $oid, $pid, $qty, $price);
	
	// Execute each query, count the total affected:
	//var_dump($_SESSION);
	//exit();
	
	$affected = 0;
	foreach ($_SESSION['cart'] as $pid => $item) {
		$qty = $item['quantity'];
		$price = $item['price'];
		mysqli_stmt_execute($stmt);
		$affected += mysqli_stmt_affected_rows($stmt);
	}

	// Close this prepared statement:
	mysqli_stmt_close($stmt);

	// Report on the success....
	if ($affected == count($_SESSION['cart'])) { // Whohoo!
	
		// Commit the transaction:
		mysqli_commit($dbc);
		
		// Clear the cart.
		unset($_SESSION['cart']);
		
		// Message to the customer:
		echo '<p>Thank you for your order. You will be notified when the items ship.</p>';
		
		// Send emails and do whatever else.
	
	} else { // Rollback and report the problem.
	
		mysqli_rollback($dbc);
		
		echo '<p>The affected rows did not equal the carts affected rows.</p>';
		// Send the order information to the administrator if you so desire.
		
	}

} else { // Rollback and report the problem.

	mysqli_rollback($dbc);

	echo '<p>The query did not run correctly</p>';
	
	// Send the order information to the administrator if you so desire.
	
}

mysqli_close($dbc);
} else {
	echo "You are not logged in, please login before continuing with the checkout process";
}
include ('includes/bottom.php');
?>
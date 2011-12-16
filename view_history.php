<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sportsman's Paradise | View Purchase History</title>
<link href="css/styles.css" rel="stylesheet" type="text/css" media="all" />
</head>
<?php include('includes/header.php');?>
<body>
<div id="content">
 <div id="content_cen">
  <div id="content_sup" class="head_pad">
   <div id="welcome_pan">
	<div align="center">
		<?php
		if (isset($_COOKIE['email'])){
			$uid=$_COOKIE['user_id'];
			include ('mysqli_connect.php');
			// Make the query:
			$q = "SELECT products.product_name, order_contents.product_id,
				order_contents.quantity, order_contents.price, orders.total
				FROM order_contents, orders, products
				WHERE products.product_id = order_contents.product_id
				AND order_contents.order_id = orders.order_id AND orders.user_id = $uid";
			$total = $row['total'];
			$r = @mysqli_query ($dbc, $q) or die("MySQL error: " . mysqli_error($dbc) . "<hr\nQuery: $q"); // Run the query.
			if (mysqli_num_rows($r)>=1) {
				// Table header:
				echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
				<tr>
				<td align="left" width="30%"><b>Product Name</b></td>
				<td align="left" width="10%"><b>Size</b></td>
				<td align="center" width="10%"><b>Quantity</b></td>
				<td align="right" width="10%"><b>Price</b></td>
				<td align="right" width="10%"><b>Total</b></td>
				</tr>';
				// Fetch and print all the records....
				$bg = '#eeeeee'; 
				while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
					$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
					echo '<tr bgcolor="' . $bg . '">
					<td align="left">' . $row['product_name'] . '</td>
					<td align="left">' . $row['size'] . '</td>
					<td align="center">' . $row['quantity'] . '</td>
					<td align="right">' . $row['price'] . '</td>
					<td align="right">' . $row['total'] . '</td>
					</tr>';
				} // End of WHILE loop.
				echo '</table>';
			mysqli_free_result($r);
			mysqli_close($dbc);
				} else {
					echo "<p>You have not made a purchase yet.</p>";
				}
		} else {
			echo "You must be logged in to view this page, I am sorry for the inconvenience.";
		}
		?>
	</div>
   </div>   
  </div>
 </div>
</div>
<?php include('includes/footer.html');?>
</body>
</html>
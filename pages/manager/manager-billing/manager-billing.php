<?php

	require '../../../middlewares/connection.php';
	require_once '../../../middlewares/checkAuth.php';

	// Check if the user is authenticated
	if (!isManagerAuthenticated()) {
		// Redirect to the login page or display a message
		header("Location: ../../index.html");
		exit();
	}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Customer Service Requests</title>
	<link rel="stylesheet" href="../../../styles/manager-billing.css">
</head>

<body>

	<header>

		<h2>SERVEASE</h2>

	</header>

	<!-- side navigation bar -->
	<aside>

		<nav class="side-nav-bar">

			<div class="nav-items">

				<ul class="nav-items-lists">

					<li class="nav-item nav-home"><a href="../dashboard/dashboard.php">Home</a></li>

					<li class="nav-item nav-customer_requests"><a href="../manager-service-requests/manager-service-requests.php">Customer Requests</a></li>

					<li class="nav-item nav-mechanics"><a href="../manager-mechanics/manager-mechanics.php">Mechanics</a></li>

                    <!-- <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li> -->

                    <li class="nav-item nav-inventory"><a href="../manager-inventory/manager-inventory.php">Inventory</a></li>

                    <li class="nav-item nav-billing active"><a href="#">Billing</a></li>

					<li class="nav-item nav-message"><a href="../manager-message/manager-message.php">Messages</a></li>

                    <li class="nav-item logout"><a href="../../../middlewares/logout.php">Logout</a></a></li>

				</ul>

			</div>

		</nav>

	</aside>

	<div class="user-profile">

		<p class="user-profile-text">
			<?php echo $_SESSION["manager"]["name"] ?>
		</p><br>

		<p class="user-profile-text">Manager</p>

	</div>

	<article class="customer-requests">

		<h2>Billing Reports</h2>

		<div class="billings-table">

			<table border="1">

				<tr>
					<th>S.N</th>
					<th>Customer Name</th>
					<th>Mechanic Name</th>
					<th>Parts</th>
					<th>Amount</th>
					<th>Status</th>
					<th>Date Time</th>
				</tr>

				<?php
					$serviceCenter = $_SESSION['manager']['service-center'];

					$sql_query_to_get_billings = "SELECT billing_id, customer_name, serviced_by, parts, amount, status, date_time FROM billings WHERE service_center = '$serviceCenter'";

					// execute the query
					$billings = mysqli_query($conn, $sql_query_to_get_billings);

					while ($rows = mysqli_fetch_assoc($billings)) {

				?>

				<tr>
					<td><?php  echo $rows['billing_id'] ?></td>
					<td><?php echo $rows['customer_name'] ?></td>
					<td><?php echo $rows['serviced_by'] ?></td>
					<td><?php echo $rows['parts'] ?></td>
					<td>Rs. <?php echo $rows['amount'] ?></td>
					<td><?php echo $rows['status'] ?></td>
					<td><?php echo $rows['date_time'] ?></td>
				</tr>

				<?php } ?>

			</table>

		</div>

	</article>
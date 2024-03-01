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
	<title>Service Requests</title>
	<link rel="stylesheet" href="../../../styles/manager-service-request.css">
</head>

<body>

	<header>

		<h2>Service Center</h2>

	</header>

	<!-- side navigation bar -->
	<aside>

		<nav class="side-nav-bar">

			<div class="nav-items">

				<ul class="nav-items-lists">

					<li class="nav-item nav-home"><a href="../dashboard/dashboard.php">Home</a></li>

					<li class="nav-item nav-customer_requests active"><a href="../manager-service-requests/manager-service-requests.php">Customer Requests</a></li>

					<li class="nav-item nav-mechanics">Mechanics</li>

					<li class="nav-item nav-drivers">Drivers</li>

					<li class="nav-item nav-inventory">Inventory</li>

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

		<h2>Customer Requests</h2>

		<div class="requests-table">

			<table border="1">

				<tr>
					<th>Name</th>
					<th>Model</th>
					<th>Date</th>
					<th>Time</th>
					<th>Contact</th>
					<th>Pickup</th>
					<th>Delivery</th>
					<th>Status</th>
					<th>Action</th>
				</tr>

				<?php
				$sql_query = "SELECT `request_id`, `requested_by`, `email`, `service_center`, `model`, `contact_number`, `requested_date`, `requested_time`, `pickup`, `pickup_address`, `delivery`, `delivery_address`, `status` FROM `service_request` WHERE `service_center` = 'TVS Kalanki'";

				// execute the query
				$service_requests = mysqli_query($conn, $sql_query);

				while ($rows = mysqli_fetch_assoc($service_requests)) {

				?>

					<tr>
						<td><?php echo $rows['requested_by'] ?></td>
						<td><?php echo $rows['model'] ?></td>
						<td><?php echo $rows['requested_date'] ?></td>
						<td><?php echo $rows['requested_time'] ?></td>
						<td><?php echo $rows['contact_number'] ?></td>
						<td><?php echo $rows['pickup_address'] ?></td>
						<td><?php echo $rows['delivery_address'] ?></td>
						<td style="width: 80px;"><?php echo $rows['status'] ?></td>
						<td style="width: 13%;">
							<button class="acceptBtn actionBtn" id="acceptButton"><a href="./send-mail.php?request_id=<?php echo $rows['request_id'] ?>">Accept</a></button>
							<button class="declineBtn actionBtn" id="declineButton"><a href="./delete-request.php?request_id=<?php echo $rows['request_id'] ?>">Decline</a></button>
						</td>
					</tr>

				<?php } ?>

			</table>

		</div>

	</article>

</body>

</html>
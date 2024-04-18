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
    <title>Manager - Message</title>
    <link rel="stylesheet" href="../../../styles/manager-message.css">
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

					<li class="nav-item nav-customer_requests active"><a href="../manager-service-requests/manager-service-requests.php">Customer Requests</a></li>

					<li class="nav-item nav-mechanics"><a href="../manager-mechanics/manager-mechanics.php">Mechanics</a></li>

                    <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li>

                   	<li class="nav-item nav-inventory"><a href="../manager-inventory/manager-inventory.php">Inventory</a></li>

					<li class="nav-item nav-billing"><a href="../manager-billing/manager-billing.php">Billing</a></li>

					<li class="nav-item nav-message"><a href="#">Messages</a></li>

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

	<article class="user-messages">

		<!-- <h2>Suggestions / Issues</h2> -->

        <h2>Suggestions / Issues</h2>

		<div class="messages-table">

			<table border="1">

				<tr>
					<th>Full Name</th>
					<th>Email / Phone</th>
					<th>Message</th>
				</tr>

				<?php
					$serviceCenter = $_SESSION['manager']['service-center'];

					$sql_query_to_get_messages = "SELECT `msg_id`, `full_name`, `email_phone`, `service_center`, `message` FROM `message` WHERE `service_center` = '$serviceCenter'";

					// execute the query
					$messages = mysqli_query($conn, $sql_query_to_get_messages);

					while ($rows = mysqli_fetch_assoc($messages)) {

				?>

				<tr>
					<td><?php echo $rows['full_name'] ?></td>
					<td><?php echo $rows['email_phone'] ?></td>
					<td><?php echo $rows['message'] ?></td>
				</tr>

				<?php } ?>

			</table>

		</div>

	</article>
    
</body>
</html>
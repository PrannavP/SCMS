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
	<link rel="stylesheet" href="../../../styles/manager-service-request.css">
	<script defer src="../../../scripts/manager-service-requests.js"></script>
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

                    <!-- <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li> -->

                   	<li class="nav-item nav-inventory"><a href="../manager-inventory/manager-inventory.php">Inventory</a></li>

					<li class="nav-item nav-billing"><a href="../manager-billing/manager-billing.php">Billing</a></li>

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
					$serviceCenter = $_SESSION['manager']['service-center'];

					$sql_query_to_get_service_requests = "SELECT request_id, requested_by, email, service_center, model, details, contact_number, requested_date, requested_time, pickup, pickup_address, delivery, delivery_address, servicing_status, mechanic_assigned, parts, amount FROM service_request WHERE service_center = '$serviceCenter'";

					// execute the query
					$service_requests = mysqli_query($conn, $sql_query_to_get_service_requests);

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
					<td style="width: 80px;"><?php echo $rows['servicing_status'] ?></td>
					<?php 
						if($rows['servicing_status'] == "Pending Approval"){
							echo '<td style="width: 16%;">';
							echo '<button class="acceptBtn actionBtn" id="acceptButton' . htmlspecialchars($rows['request_id'], ENT_QUOTES) . '" onclick="openAcceptModal(' . htmlspecialchars($rows['request_id'], ENT_QUOTES) . ', \'' . addslashes(htmlspecialchars($rows['details'], ENT_QUOTES)) . '\', \'' . htmlspecialchars($rows['amount'], ENT_QUOTES) . '\')">Accept</button>';
							echo '<button class="declineBtn actionBtn" id="declineButton' . htmlspecialchars($rows['request_id'], ENT_QUOTES) . '"><a href="./delete-request.php?request_id=' . htmlspecialchars($rows['request_id'], ENT_QUOTES) . '">Decline</a></button>';
							echo '</td>';							
						}elseif($rows['servicing_status'] == "Completed Servicing"){
							echo '<td style="width: 16%;">';
							echo '<button style="margin-left: 28%;" class="actionBtn acceptBtn" id="viewDetailsButton" onclick="openDetailsModal(' . $rows['request_id'] . ', \'' . $rows['details'] . '\', \'' . $rows['amount'] . '\', \'' . $rows['servicing_status'] . '\', \'' . $rows['parts'] . '\')">Details</button>';
							echo '</td>';
						}else{
							echo '<td style="width: 16%";>';
							echo '<button class="actionBtn acceptBtn" id="viewDetailsButton" onclick="openDetailsModal(' . $rows['request_id'] . ', \'' . $rows['details'] . '\', \'' . $rows['amount'] . '\', \'' . $rows['servicing_status'] . '\', \'' . $rows['parts'] . '\')">Details</button>';
							echo '<button class="actionBtn declineBtn" id="completedServicing"><a href="./complete-servicing.php?request_id=' . $rows['request_id'] . '">Complete</a></button>';
							echo '</td>';
						}
					?>
				</tr>

				<?php } ?>

			</table>

		</div>

	</article>

	<div class="confirm-service-container">

        <div class="confirm-service-content">

            <center><h2>Accept Servicve Request</h2></center>
            
            <form action="send-mail.php" method="post">

                <div class="close-edit-menu">

                    <svg id="closeEditBtn" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.25 4.75l-6.5 6.5m0-6.5l6.5 6.5" />
                    </svg>

                </div>

                <div class="id-input">

                    <label for="request_id">Request ID:</label><br>
                    <input type="number" name="request_id" id="request_id" readonly="true">
                    
                </div>

				<div class="details-field">
					<label for="customer-servicing-detail">Details:</label><br>
					<textarea name="servicing-details"  id="customer-servicing-detail" cols="38" rows="4"></textarea>
				</div>

                <div class="assignMechanic-field">

                    <label for="mechanic_name">Assign Mechanic</label><br>
                    <select name="mechanic_name" id="mechanic_name">
						<?php
							require '../../../middlewares/connection.php';

							$serviceCenter = $_SESSION['manager']['service-center'];

							// query to get all the mechanics list
							$query_get_all_mechanics_list = "SELECT * FROM mechanic WHERE service_center = '$serviceCenter'";
							$mechanics_result = mysqli_query($conn, $query_get_all_mechanics_list);

							while($mechanic_row = mysqli_fetch_assoc($mechanics_result)){
								echo "<option>" . $mechanic_row['fullname'] . "</option>";
							};
						?>
					</select>

                </div>

				<div class="servicing-amount-field">

					<label for="amount">Amount:</label><br>
					<input type="number" id="amount" name="amount">

				</div>

                <button id="confirmRequestButton">Confirm</button>

            </form>

        </div>

    </div>

	<!-- details popup modal -->
	<div class="details-service-container">

		<div class="details-service-content">

			<center><h2>Servicve Details</h2></center>
            
            <form action="servicing-details.php" method="post">

                <div class="close-edit-menu">

                    <svg id="details-closeDetailstBtn" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.25 4.75l-6.5 6.5m0-6.5l6.5 6.5" />
                    </svg>

                </div>

                <div class="id-input">

                    <label for="request_id">Request ID:</label><br>
                    <input type="number" name="request_id" id="details-request_id" readonly="true">
                    
                </div>

				<div class="details-field">
					<label for="customer-servicing-detail">Details:</label><br>
					<textarea name="servicing-details"  id="details-customer-servicing-detail" cols="38" rows="4"></textarea>
				</div>

				<div class="servicingStatus-field">

                    <label for="servicing_status">Servicing Status</label><br>
                    <input type="text" name="servicing_status" id="details-servicing_status" readonly>

                </div>

				<div class="parts-field">

					<label for="parts">Parts:</label><br>
					<textarea name="parts" id="details-parts" cols="38" rows="4"></textarea>

				</div>

				<div class="servicing-amount-field">

					<label for="details-amount">Amount:</label><br>
					<input type="number" id="details-amount" name="details-amount">

				</div>

                <button id="changeDetailsButton">Confirm</button>

            </form>

		</div>

	</div>

</body>

</html>
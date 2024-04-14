<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isCustomerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../customer-login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request History</title>
    <link rel="stylesheet" href="../../../styles/customer-request-history.css">
</head>
<body>

    <?php // echo $_SESSION["manager"]["service-center"] ?>

    <!-- <p><?php /*echo $_SESSION["user_type"]*/ ?></p>
    <p><?php /*echo $_SESSION["manager"]["name"]*/ ?></p> -->
    <!-- <button><a href="../../middlewares/logout.php">Logout</a></button> -->

    <header>

        <h2>Service Center</h2>

    </header>

    <!-- side navigation bar --> 
    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home"><a href="../dashboard/customer.php">Dashboard</a></li>

                    <li class="nav-item nav-customer_requests active"><a href="../customer-request-history/customer-request-history.php">Requests History</a></li>

                    <li class="nav-item nav-mechanics"><a href="../customer-spare-parts/customer-spare-parts.php">Spare Parts</a></li>

                    <li class="nav-item nav-inventory"><a href="../customer-suggestion-issue/customer-suggestion-issue.php">Suggestion / Issues</a></li>

                    <li class="nav-item logout"><a href="../../../middlewares/logout.php">Logout</a></a></li>

                </ul>

            </div>

        </nav>

    </aside>

    <div class="user-profile">

        <p class="user-profile-text">
            <?php echo $_SESSION["customer"]["name"] ?>
        </p><br>

        <p class="user-profile-text">Customer</p>

    </div>

    <article class="requests-history">

		<h2>Requests History</h2>

		<div class="requests-table">

			<table border="1">

				<tr>
					<th>Date</th>
					<th>Time</th>
					<th>Service Center</th>
					<th>Details</th>
					<th>Status</th>
					<th>Mechanic</th>
					<th>Parts</th>
					<th>Amount</th>
				</tr>

				<?php
					$customer_name = $_SESSION["customer"]["name"];

					$sql_query_to_get_requests_history = "SELECT request_id, service_center, details, requested_date, requested_time, servicing_status, mechanic_assigned, parts, amount FROM service_request WHERE requested_by = '$customer_name'";

					// execute the query
					$service_requests = mysqli_query($conn, $sql_query_to_get_requests_history);

					while ($rows = mysqli_fetch_assoc($service_requests)) {

				?>

				<tr>
					<td><?php echo $rows['requested_date'] ?></td>
					<td><?php echo $rows['requested_time'] ?></td>
					<td><?php echo $rows['service_center'] ?></td>
					<td><?php echo $rows['details'] ?></td>
					<td><?php echo $rows['servicing_status'] ?></td>
					<td><?php echo $rows['mechanic_assigned'] ?></td>
					<td><?php echo $rows['parts'] ?></td>
					<td>Rs. <?php echo $rows['amount'] ?></td>
				</tr>

				<?php } ?>

			</table>

		</div>

	</article>
    
</body>
</html>
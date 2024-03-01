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
    <title>Manager - Mechanics</title>
    <link rel="stylesheet" href="../../../styles/manager-mechanics.css">
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

                    <li class="nav-item nav-customer_requests "><a href="../manager-service-requests/manager-service-requests.php">Customer Requests</a></li>

                    <li class="nav-item nav-mechanics active"><a href="../manager-mechanics/manager-mechanics.php">Mechanics</a></li>

                    <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li>

                    <li class="nav-item nav-inventory"><a href="../manager-inventory/manager-inventory.php">Inventory</a></li>

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

    <article class="mechanics">

		<h2>Mechanics</h2>

		<div class="mechanics-table">

			<table border="1">

				<tr>
					<th>Mechanic Name</th>
					<th>Mechanic Number</th>
                    <th>Address</th>
                    <th>Date of Joining</th>
				</tr>

                <?php 
					$serviceCenter = $_SESSION['manager']['service-center'];

                    $sql_query_to_get_mechanics = "SELECT mechanic_id, fullname, contactnumber, address, date_of_joining FROM mechanic WHERE service_center = '$serviceCenter'";

                    // execute the query
                    $mechanics = mysqli_query($conn, $sql_query_to_get_mechanics);

                    while($rows = mysqli_fetch_assoc($mechanics)){
                ?>

                <tr>
                    <td><?php echo $rows['fullname'] ?></td>
                    <td><?php echo $rows['contactnumber'] ?></td>
                    <td><?php echo $rows['address'] ?></td>
                    <td><?php echo $rows['date_of_joining'] ?></td>
                </tr>

                <?php } ?>

			</table>

		</div>

	</article>
    
</body>
</html>
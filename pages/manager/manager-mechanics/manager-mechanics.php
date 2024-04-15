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

        <h2>SERVEASE</h2>

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
                    
                    <li class="nav-item nav-billing"><a href="../manager-billing/manager-billing.php">Billing</a></li>

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

		<h2 style="display: inline-block;">Mechanics</h2>

        <div class="addMechanicContainer" id="addMechanic">

            <button id="openModalBtn">Add Mechanic</button>

        </div>

		<div class="mechanics-table">

			<table border="1">

				<tr>
					<th>Mechanic Name</th>
					<th>Mechanic Number</th>
                    <th>Address</th>
                    <th>Date of Joining</th>
                    <th>Action</th>
				</tr>

                <?php 
					$serviceCenter = $_SESSION['manager']['service-center'];

                    $sql_query_to_get_mechanics = "SELECT mechanic_id, fullname, contactnumber, address, date_of_joining FROM mechanic WHERE service_center = '$serviceCenter'";

                    // execute the query
                    $mechanics = mysqli_query($conn, $sql_query_to_get_mechanics);

                    while($rows = mysqli_fetch_assoc($mechanics)){
                ?>

                <tr>
                    <td class="fullname"><?php echo $rows['fullname'] ?></td>
                    <td class="contactnumber"><?php echo $rows['contactnumber'] ?></td>
                    <td class="address"><?php echo $rows['address'] ?></td>
                    <td class="datejoined"><?php echo $rows['date_of_joining'] ?></td>
                    <td>
                        <button class="editBtn actionBtn" id="editButton" onclick="showEditMenu('<?php echo $rows['mechanic_id'] ?>', '<?php echo $rows['fullname'] ?>', '<?php echo $rows['contactnumber'] ?>', '<?php echo $rows['address'] ?>')"><a href="#">Edit</a></button>
                        <button class="removeBtn actionBtn" id="removeButton"><a href="./remove-mechanics.php?mechanic_id=<?php echo $rows['mechanic_id'] ?>">Remove</a></button>
                    </td>
                </tr>

                <?php } ?>

			</table>

		</div>

	</article>

    <div class="edit-mechanic-container">

        <div class="edit-mechanic-content">

            <center><h2>Edit Mechanics</h2></center>
            
            <form action="edit-mechanics.php" method="post">

                <div class="close-edit-menu">

                    <svg id="closeEditBtn" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.25 4.75l-6.5 6.5m0-6.5l6.5 6.5" />
                    </svg>

                </div>

                <div class="id-input" style="display: none;">

                    <label for="mechanic_id">ID:</label><br>
                    <input type="number" name="mechanicid" id="mechanicid" readonly="true">
                    
                </div>

                <div class="name-input">

                    <label for="fullname">Full Name: </label><br>
                    <input type="text" id="fullname" name="fullname">

                </div>

                <div class="contactnumber-input">

                    <label for="contactnumber">Contact Number: </label><br>
                    <input type="text" id="contactnumber" name="contactnumber">

                </div>

                <div class="address-input">

                    <label for="address">Address: </label><br>
                    <input type="text" id="address" name="address">

                </div>

                <!-- <div class="datejoined-input">

                    <label for="datejoined">Date Joined</label><br>
                    <input type="datetime-local" id="datejoined" name="datejoined">

                </div> -->

                <div class="editButton">

                    <button id="editBtn">Edit</button>

                </div>

            </form>

        </div>

    </div>

    <div class="add-mechanic-container">

        <div class="add-mechanic-container-content">

            <center><h2>Add Mechanic</h2></center>

            <form action="add-mechanics.php" method="post">

                <div class="close-add-menu">

                    <svg id="closeAddBtn" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.25 4.75l-6.5 6.5m0-6.5l6.5 6.5" />
                    </svg>

                </div>

                <div class="mechanic-name">

                    <label for="mechanicname">Mechanic Name:</label><br>
                    <input type="text" name="mechanicname" id="mechanicname">

                </div>

                <div class="mechanic-contactnumber">

                    <label for="mechanic-contactnumber">Mechanic Contact:</label><br>
                    <input type="number" name="mechanic-contactnumber" id="mechanic-contactnumber">

                </div>

                <div class="mechanic-address">

                    <label for="mechanic-address">Mechanic Address:</label><br>
                    <input type="text" name="mechanic-address" id="mechanic-address">

                </div>

                <div class="addButton">

                    <button id="addBtn">Add Mechanic</button>

                </div>

            </form>

        </div>

    </div>

    <script src="../../../scripts/manager-mechanics.js"></script>
    
</body>
</html>
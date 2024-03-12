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
    <title>Manager - Drivers</title>
    <link rel="stylesheet" href="../../../styles/manager-drivers.css">
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

                    <li class="nav-item nav-mechanics"><a href="../manager-mechanics/manager-mechanics.php">Mechanics</a></li>

                    <li class="nav-item nav-drivers active"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li>

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

    <article class="drivers">

        <h2>Drivers</h2>

        <div class="drivers-table">

            <table border="1">

                <tr>
                    <th>Driver Name</th>
                    <th>Driver Number</th>
                    <th>License Number</th>
                    <th>License Expiration Date</th>
                    <th>Date of Joining</th>
                    <th>Action</th>
                </tr>

                <?php 
                    $serviceCenter = $_SESSION['manager']['service-center'];

                    $sql_query_to_get_drivers = "SELECT driver_id, full_name, contact_number, license_number, license_expirydate, date_of_joining FROM drivers WHERE service_center = '$serviceCenter'";

                    // execute the query
                    $drivers = mysqli_query($conn, $sql_query_to_get_drivers);

                    while($rows = mysqli_fetch_assoc($drivers)){
                ?>

                <tr>
                    <td><?php echo $rows["full_name"] ?></td>
                    <td><?php echo $rows["contact_number"] ?></td>
                    <td><?php echo $rows["license_number"] ?></td>
                    <td><?php echo $rows["license_expirydate"] ?></td>
                    <td><?php echo $rows["date_of_joining"] ?></td>
                    <td>
                        <button class="editBtn actionBtn" id="editButton" onclick="showEditMenu('<?php echo $rows['driver_id'] ?>', '<?php echo $rows['full_name'] ?>', '<?php echo $rows['contact_number'] ?>', '<?php echo $rows['license_number'] ?>')"><a href="#">Edit</a></button>
                        <button class="removeBtn actionBtn" id="removeButton"><a href="./remove-drivers.php?driver_id=<?php echo $rows['driver_id'] ?>">Remove</a></button>
                    </td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </article>

    <div class="edit-driver-container">

        <div class="edit-driver-content">

            <center><h2>Edit Driver</h2></center>
            
            <form action="edit-drivers.php" method="post">

                <div class="close-edit-menu">

                    <svg id="closeEditBtn" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.25 4.75l-6.5 6.5m0-6.5l6.5 6.5" />
                    </svg>

                </div>

                <div class="id-input" style="display: none;">

                    <label for="driver_id">ID:</label><br>
                    <input type="number" name="driverid" id="driverid" readonly="true">
                    
                </div>

                <div class="name-input">

                    <label for="full_name">Full Name: </label><br>
                    <input type="text" id="fullname" name="fullname">

                </div>

                <div class="contactnumber-input">

                    <label for="contactnumber">Contact Number: </label><br>
                    <input type="text" id="contactnumber" name="contactnumber">

                </div>

                <div class="license-input">

                    <label for="address">License Number: </label><br>
                    <input type="text" id="licensenumber" name="licensenumber">

                </div>

                <!-- <div class="license_expiry-input">

                    <label for="license_expiry">License Number: </label><br>
                    <input type="text" id="licenseexpiry" name="licenseexpiry">

                </div> -->

                <div class="editButton">

                    <button id="editBtn">Edit</button>

                </div>

            </form>

        </div>

    </div>

    <script src="../../../scripts/manager-drivers.js"></script>
    
</body>
</html>
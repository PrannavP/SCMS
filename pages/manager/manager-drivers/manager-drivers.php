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
                        <button class="editBtn actionBtn" id=""><a href="#">Edit</a></button>
                        <button class="removeBtn actionBtn" id="removeButton"><a href="./remove-drivers.php?driver_id=<?php echo $rows['driver_id'] ?>">Remove</a></button>
                    </td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </article>

    <div class="editformpopup" id="editDriverForm">
        
        <form action="" method="post">

            

        </form>

    </div>
    
</body>
</html>
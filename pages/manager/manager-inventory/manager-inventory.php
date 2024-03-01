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
    <title>Manager - Inventory</title>
    <link rel="stylesheet" href="../../../styles/manager-inventory.css">
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

                    <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li>

                    <li class="nav-item nav-inventory active"><a href="../manager-inventory/manager-inventory.php">Inventory</a></li>

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

    <article class="inventory">

        <h2>Inventory</h2>

        <div class="inventory-table">

            <table border="1">

                <tr>
                    <th>ID</th>
                    <th>Part Name</th>
                    <th>Price</th>
                </tr>

                <?php 
                    $service_center = $_SESSION['manager']['service-center'];

                    $sql_to_get_invetory = "SELECT item_name, item_number, item_quantity, item_price FROM inventory";

                    // execute the query
                    $items = mysqli_query($conn, $sql_to_get_invetory);

                    while($rows = mysqli_fetch_assoc($items)){
                ?>

                <tr>
                    <td><?php echo $rows["item_number"] ?></td>
                    <td><?php echo $rows["item_name"] ?></td>
                    <td><?php echo $rows["item_price"] ?></td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </article>
    
</body>
</html>
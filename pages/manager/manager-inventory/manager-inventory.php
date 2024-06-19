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

        <h2>SERVEASE</h2>

    </header>

    <!-- side navigation bar -->
    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home"><a href="../dashboard/dashboard.php">Home</a></li>

                    <li class="nav-item nav-customer_requests "><a href="../manager-service-requests/manager-service-requests.php">Customer Requests</a></li>

                    <li class="nav-item nav-mechanics"><a href="../manager-mechanics/manager-mechanics.php">Mechanics</a></li>

                    <!-- <li class="nav-item nav-drivers"><a href="../manager-drivers/manager-drivers.php">Drivers</a></li> -->

                    <li class="nav-item nav-inventory active"><a href="../manager-inventory/manager-inventory.php">Inventory</a></li>

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

    <article class="inventory">

        <h2>Inventory</h2>

        <div class="addItemBtn" id="addItem">

            <button id="openModalBtn">Add Item</button>

        </div>

        <div class="inventory-table">

            <table border="1">

                <tr>
                    <th>Part Number</th>
                    <th>Part Name</th>
                    <th>In Stock</th>
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
                    <td><?php echo $rows["item_quantity"] ?></td>
                    <td><?php echo $rows["item_price"] ?></td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </article>

    <div class="add-item-container">

        <div class="add-item-container-content">

            <center><h2>Add Scooter/Bike Part</h2></center>

            <form action="add-item-inventory.php" method="post">

                <div class="close-add-menu">

                    <svg id="closeAddBtn" xmlns="http://www.w3.org/2000/svg" width="2em" height="2em" viewBox="0 0 16 16">
                        <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m11.25 4.75l-6.5 6.5m0-6.5l6.5 6.5" />
                    </svg>

                </div>

                <div class="part-number">

                    <label for="partnumber">Part Number:</label><br>
                    <input type="text" name="partnumber" id="partnumber">

                </div>

                <div class="part-name">

                    <label for="partname">Part Name:</label><br>
                    <input type="text" name="partname" id="partname">

                </div>

                <div class="part-quantity">

                    <label for="partquantity">Part Quantity:</label><br>
                    <input type="number" name="partquantity" id="partquantity">

                </div>

                <div class="part-price">

                    <label for="partprice">Part Price:</label><br>
                    <input type="number" name="partprice" id="partprice">

                </div>

                <div class="addButton">

                    <button id="addBtn">Add</button>

                </div>

            </form>

        </div>

    </div>

    <script src="../../../scripts/manager-inventory.js"></script>
    
</body>
</html>
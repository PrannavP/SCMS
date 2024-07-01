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
    <title>Spare Parts</title>
    <link rel="stylesheet" href="../../../styles/customer-spare-parts.css">
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

                    <li class="nav-item nav-home"><a href="../dashboard/customer.php">Dashboard</a></li>

                    <li class="nav-item nav-request_history"><a href="../customer-request-history/customer-request-history.php">Requests History</a></li>

                    <li class="nav-item nav-spare_parts active"><a href="../customer-spare-parts/customer-spare-parts.php">Spare Parts</a></li>

                    <li class="nav-item nav-suggestion_issue"><a href="../customer-suggestion-issue/customer-suggestion-issue.php">Suggestion / Issues</a></li>

                    <li class="nav-item nav-profile"><a href="../customer-edit-details/customer-profile.php">Profile</a></li>

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

    <article class="spareparts-container">

		<h2>Spare Parts</h2>

		<div class="spareparts-table">

			<table border="1">

				<tr>
					<th>Part Number</th>
					<th>Part Name</th>
					<th>Price</th>
					<th>Price with VAT</th>
				</tr>

				<?php

					$sql_query_to_get_parts_list= "SELECT `item_number`, `item_name`, `item_price`, `service_center` FROM `inventory`";
					// execute the query
					$service_requests = mysqli_query($conn, $sql_query_to_get_parts_list);

					while ($rows = mysqli_fetch_assoc($service_requests)) {
                        $price_with_vat = $rows['item_price'] * 1.13;
				?>

				<tr>
					<td><?php echo $rows['item_number'] ?></td>
					<td><?php echo $rows['item_name'] ?></td>
					<td><?php echo $rows['item_price'] ?></td>
					<td><?php echo $price_with_vat ?></td>
				</tr>

				<?php } ?>

			</table>

		</div>

	</article>
    
</body>
</html>
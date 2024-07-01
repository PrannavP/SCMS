<?php

	require '../../../middlewares/connection.php';
	require_once '../../../middlewares/checkAuth.php';

	// Check if the user is authenticated
	if (!isAdminAuthenticated()) {
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
    <title>Admin | Servease</title>
    <link rel="stylesheet" href="../../../styles/admin-manager.css">
</head>
<body>

        <header>

    <h2>SERVEASE</h2>

    </header>

    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home"><a href="../dashboard/admin-dashboard.php">Home</a></li>

                    <li class="nav-item nav-admin-managers active"><a href="#">Managers</a></li>

                    <li class="nav-item nav-admin-service_centers"><a href="../admin-service-centers/admin-service-centers.php">Service Centers</a></li>

                    <li class="nav-item logout"><a href="../../../middlewares/logout.php">Logout</a></a></li>

                </ul>

            </div>

        </nav>

    </aside>

    <!-- Service Center Listing -->
    <article class="managers">

        <h2 style="display: inline-block;">Managers</h2>

        <div class="managers-table">

            <table border="1">

                <tr>
                    <th>ID</th>
                    <th>Full Name</th>
                    <th>Contact Number</th>
                    <th>Service Center</th>
                    <th>Action</th>
                </tr>

                <?php 
                    $sql_query_to_get_managers = "SELECT `id`, `fullname`, `contact_number`, `service_center` FROM `manager`";

                    // execute the query
                    $managers = mysqli_query($conn, $sql_query_to_get_managers);

                    while($rows = mysqli_fetch_assoc($managers)){
                ?>

                <tr>
                    <td class="id"><?php echo $rows['id'] ?></td>
                    <td class="name"><?php echo $rows['fullname'] ?></td>
                    <td class="location"><?php echo $rows['contact_number'] ?></td>
                    <td class="contact_person"><?php echo $rows['service_center'] ?></td>
                    <td>
                        <!-- <button class="editBtn actionBtn" id="editButton" onclick="showEditMenu('<?php echo $rows['mechanic_id'] ?>', '<?php echo $rows['fullname'] ?>', '<?php echo $rows['contactnumber'] ?>', '<?php echo $rows['address'] ?>')"><a href="#">Edit</a></button> -->
                        <button class="removeBtn actionBtn" id="removeButton"><a href="./remove-manager.php?manager_id=<?php echo $rows['id'] ?>">Remove</a></button>
                    </td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </article>    
    
</body>
</html>
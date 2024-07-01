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
    <link rel="stylesheet" href="../../../styles/admin-service-centers.css">
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

                    <li class="nav-item nav-admin-managers"><a href="../admin-managers/admin-managers.php">Managers</a></li>

                    <li class="nav-item nav-admin-service_centers active"><a href="../admin-service-centers/admin-service-centers.php">Service Centers</a></li>

                    <li class="nav-item logout"><a href="../../../middlewares/logout.php">Logout</a></a></li>

                </ul>

            </div>

        </nav>

    </aside>

    <!-- Service Center Listing -->
    <article class="service_centers">

        <h2 style="display: inline-block;">Service Centers</h2>

        <div class="mechanics-table">

            <table border="1">

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Contact Person</th>
                    <th>Contact Number</th>
                    <th>Slots</th>
                    <th>Action</th>
                </tr>

                <?php 
                    $sql_query_to_get_service_centers = "SELECT * FROM `servicecenter`";

                    // execute the query
                    $service_centers = mysqli_query($conn, $sql_query_to_get_service_centers);

                    while($rows = mysqli_fetch_assoc($service_centers)){
                ?>

                <tr>
                    <td class="id"><?php echo $rows['id'] ?></td>
                    <td class="name"><?php echo $rows['name'] ?></td>
                    <td class="location"><?php echo $rows['location'] ?></td>
                    <td class="contact_person"><?php echo $rows['contact_person'] ?></td>
                    <td class="contact_number"><?php echo $rows['contact_number'] ?></td>
                    <td class="slots"><?php echo $rows['slots'] ?></td>
                    <!-- <td>
                        <button class="editBtn actionBtn" id="editButton" onclick="showEditMenu('<?php echo $rows['mechanic_id'] ?>', '<?php echo $rows['fullname'] ?>', '<?php echo $rows['contactnumber'] ?>', '<?php echo $rows['address'] ?>')"><a href="#">Edit</a></button>
                        <button class="removeBtn actionBtn" id="removeButton"><a href="./remove-mechanics.php?mechanic_id=<?php echo $rows['mechanic_id'] ?>">Remove</a></button>
                    </td> -->
                    <td>
                        <button>Edit</button>
                        <button>Delete</button>
                    </td>
                </tr>

                <?php } ?>

            </table>

        </div>

    </article>     

</body>
</html>
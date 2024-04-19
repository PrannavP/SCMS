<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isAdminAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../admin-login.html");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../../styles/admin-dashboard.css">
</head>
<body>

    <?php // echo $_SESSION["manager"]["service-center"] ?>

    <!-- <p><?php /*echo $_SESSION["user_type"]*/ ?></p>
    <p><?php /*echo $_SESSION["manager"]["name"]*/ ?></p> -->
    <!-- <button><a href="../../middlewares/logout.php">Logout</a></button> -->

    <header>

        <h2>SERVEASE</h2>

    </header>

    <!-- side navigation bar --> 
    <div class="user-profile">

        <p class="user-profile-text">
            <?php echo $_SESSION["admin"]["email"] ?>
        </p><br>

        <p class="user-profile-text">Admin</p>

        <a href="../../../middlewares/logout.php">Logout</a>

    </div>

    <article class="dashboard">
        
        <h2>Dashboard</h2>

        <section class="create-manager-section">

            <h3 class="create-manager-heading">Create Manager's Account</h3>

            <form action="create-manager.php" method="post">

                <div class="fullname-field">

                <label for="manager-fullname">Full Name</label><br>

                <input type="text" name="manager-fullname" id="manager-fullname">

            </div>

            <div class="contactnumber-field">

                <label for="manager-contactnumber">Contact Number</label><br>

                <input type="number" name="manager-contactnumber" id="manager-contactnumber">

            </div>

            <div class="email-field">

                <label for="manager-email">Email</label><br>

                <input type="email" name="manager-email" id="manager-email">

            </div>

            <div class="password-field">

                <label for="manager-password">Password</label><br>

                <input type="password" name="manager-password" id="manager-password">

            </div>

            <div class="service_center-field">

                <label for="manager-service_center">Service Center:</label><br>

                <select name="service_center" id="service_center">
                    <option>Choose the service center</option>
                        <?php
                            require '../../../middlewares/connection.php';

                            $query_to_get_all_service_centers = "SELECT `name` FROM `servicecenter`";

                            $service_center_lists = mysqli_query($conn, $query_to_get_all_service_centers);

                            while($service_center_list = mysqli_fetch_assoc($service_center_lists)){
                                echo "<option>" . $service_center_list['name'] . "</option>";
                            }
                        ?>
                    </select>

            </div>

            <div class="manager-submit-button-field">

                <button class="manager-submit-button">Create Manager</button>

            </div>

            </form>

        </section>

        <section class="create-servicing-section">

            <h3 class="create-service_center-heading">Create New Service Center</h3>

            <form action="./create-service_center.php" method="post">

                <div class="service_center-name-field">

                    <label for="service_center-name">Service Center Name</label><br>

                    <input type="text" name="service_center-name" id="service_center-name">

                </div>

                <div class="service_center-location-field">

                    <label for="service_center-location">Location</label><br>

                    <input type="text" name="service_center-location" id="service_center-location">

                </div>

                <div class="service_center-contactnumber-field">

                    <label for="service_center-contactnumber">Contact Number</label><br>

                    <input type="number" name="service_center-contactnumber" id="service_center-contactnumber">

                </div>

                <div class="service_center-contactperson-field">

                    <label for="service_center-contactperson">Contact Person</label><br>

                    <input type="text" name="service_center-contactperson" id="service_center-contactperson">

                </div>

                <div class="service_center-slots-field">

                    <label for="service_center-slots">Slots</label><br>

                    <input type="number" name="service_center-slots" id="service_center-slots">

                </div>

                <div class="service_center-submit-button-field">

                    <button class="service_center-submit-button">Create Service Center</button>

                </div>

            </form>

        </section>

    </article>
    
</body>
</html>
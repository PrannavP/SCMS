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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../../styles/customer-dashboard.css">
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
    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home active"><a href="#">Dashboard</a></li>

                    <li class="nav-item nav-customer_requests"><a href="../customer-request-history/customer-request-history.php">Requests History</a></li>

                    <li class="nav-item nav-mechanics"><a href="../customer-spare-parts/customer-spare-parts.php">Spare Parts</a></li>

                    <li class="nav-item nav-inventory"><a href="../customer-suggestion-issue/customer-suggestion-issue.php">Suggestion / Issues</a></li>

                    <li class="nav-item nav-inventory"><a href="../customer-edit-details/customer-edit.php">Profile</a></li>

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

    <article class="dashboard">
        
        <h2>Dashboard</h2>

        <section class="service-centers-container">

            <h4>Available Service Centers</h4>

            <div class="service-centers">

                    <?php 
                    
                        require '../../../middlewares/connection.php';

                        // Query
                        $sql_query_to_get_service_centers = "SELECT `name`, `location`, `available_slots`, `contact_number` FROM servicecenter ORDER BY `available_slots` DESC";

                        // Execute the query
                        $service_centers = mysqli_query($conn, $sql_query_to_get_service_centers);

                        while($rows = mysqli_fetch_assoc($service_centers)){ 
                            
                    ?>

                    <div class="service-center">

                            <div class="left-column">

                                <p class="service-center-name"><?php echo $rows["name"] ?></p><br>
                        
                                <p class="service-center-location"><?php echo $rows["location"] ?></p>

                            </div>

                            <div class="right-column">

                                <p class="service-center_slots">Slots: <?php echo $rows["available_slots"] ?></p><br>

                                <p class="service-center_contact">Contact: <?php echo $rows["contact_number"] ?></p>

                            </div>

                    </div>

                    <?php } ?>

            </div>

        </section>

        <section class="servicing-section">
            
            <div class="request-section">

				<div class="section-title">

                    <h4>Request Servicing</h4>

                </div>

                <form action="./request-servicing.php" method="post">

                    <div class="section-service_center">

                        <label for="service-center">Service Center</label><br>

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

                    <div class="section-date">

                        <label for="date">Date</label><br>

                        <input type="date" name="date" id="date">

                    </div>

                    <div class="section-time">

                        <label for="time">Time</label><br>

                        <select name="time" id="time">
                            <option>Choose the desired time</option>
                            <option>10am-11am</option>
                            <option>11am-12pm</option>
                            <option>12pm-01pm</option>
                            <option>02pm-03pm</option>
                            <option>04pm-05pm</option>
                            <option>05pm-06am</option>
                        </select>

                    </div>

                    <div class="section-model">

                        <label for="model">Model</label><br>

                        <select name="model" id="model" required>
                            <option value="" selected>SELECT YOUR MODEL</option>
                            <option value="TVS-NTORQ-REFI">TVS-NTORQ-REFI</option>
                            <option value="TVS-NTORQ">TVS-NTORQ</option>
                            <option value="TVS-RAIDER">TVS-RAIDER</option>
                            <option value="TVS-APACHE-RTR">TVS-APACHE-RTR</option>
                            <option value="TVS-JUPITER">TVS-JUPITER</option>
                            <option value="TVS-RAEDON">TVS-RAEDON</option>
                        </select>

                    </div>

                    <div class="section-contact">

                        <label for="contact-number">Contact Number</label><br>
                            
                        <input type="number" name="contact-number" id="contact-number">

                    </div>

                    <div class="section-detail">

                        <label for="detail">Detail</label><br>

                        <textarea name="detail" id="detail" cols="35" rows="5"></textarea>

                    </div>

                    <div class="section-button">

                        <button class="request-button">Request</button>

                    </div>

                </form>

            </div>

        </section>

    </article>
    
</body>
</html>
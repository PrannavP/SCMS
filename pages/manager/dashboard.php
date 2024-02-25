<?php

    require '../../middlewares/connection.php';
    require_once '../../middlewares/checkAuth.php';

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
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../styles/manager-dashboard.css">
</head>
<body>

    <!-- <p><?php /*echo $_SESSION["user_type"]*/ ?></p>
    <p><?php /*echo $_SESSION["manager"]["name"]*/ ?></p> -->
    <!-- <button><a href="../../middlewares/logout.php">Logout</a></button> -->

    <header>

        <h2>TVS Service Center</h2>

    </header>

    <!-- side navigation bar --> 
    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home active">Home</li>

                    <li class="nav-item nav-customer_requests">Customer Requests</li>

                    <li class="nav-item nav-mechanics">Mechanics</li>

                    <li class="nav-item nav-drivers">Drivers</li>

                    <li class="nav-item nav-inventory">Inventory</li>

                    <li class="nav-item logout"><a href="../../middlewares/logout.php">Logout</a></a></li>

                </ul>

            </div>

        </nav>

    </aside>

    <div class="user-profile">

        <p class="user-profile-text">Ram Karki</p><br>

        <p class="user-profile-text">Manager</p>

    </div>

    <article class="dashboard">
        
        <h2>Dashboard</h2>

        <section class="recent-serivce-requests">

            <h4>Service Requests</h4>

            <div class="service-requests">

                <div class="service-request">

                    <?php 
                    
                        require '../../middlewares/connection.php';

                        // query
                        $sql_query = ""

                    ?>
                
                </div>

            </div>

        </section>

    </article>
    
</body>
</html>
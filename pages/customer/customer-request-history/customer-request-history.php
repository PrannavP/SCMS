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
    <title>Request History</title>
    <link rel="stylesheet" href="../../../styles/customer-request-history.css"
</head>
<body>

    <?php // echo $_SESSION["manager"]["service-center"] ?>

    <!-- <p><?php /*echo $_SESSION["user_type"]*/ ?></p>
    <p><?php /*echo $_SESSION["manager"]["name"]*/ ?></p> -->
    <!-- <button><a href="../../middlewares/logout.php">Logout</a></button> -->

    <header>

        <h2>Service Center</h2>

    </header>

    <!-- side navigation bar --> 
    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home"><a href="../dashboard/customer.php">Dashboard</a></li>

                    <li class="nav-item nav-customer_requests active"><a href="../customer-request-history/customer-request-history.php">Requests History</a></li>

                    <li class="nav-item nav-mechanics"><a href="../customer-spare-parts/customer-spare-parts.php">Spare Parts</a></li>

                    <li class="nav-item nav-inventory"><a href="../customer-suggestion-issue/customer-suggestion-issue.php">Suggestion / Issues</a></li>

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
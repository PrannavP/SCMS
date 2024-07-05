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
    <title>ServEase</title>
    <link rel="stylesheet" href="../../../styles/customer-profile.css">
</head>
<body>

    <header>

        <h2>ServEase</h2>

    </header>

    <!-- side navigation bar --> 
    <aside>

        <nav class="side-nav-bar">

            <div class="nav-items">

                <ul class="nav-items-lists">

                    <li class="nav-item nav-home"><a href="../dashboard/customer.php">Dashboard</a></li>

                    <li class="nav-item nav-customer_requests"><a href="../customer-request-history/customer-request-history.php">Requests History</a></li>

                    <li class="nav-item nav-mechanics"><a href="../customer-spare-parts/customer-spare-parts.php">Spare Parts</a></li>

                    <li class="nav-item nav-inventory"><a href="../customer-suggestion-issue/customer-suggestion-issue.php">Suggestion / Issues</a></li>

                    <li class="nav-item nav-inventory active"><a href="#">Profile</a></li>

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

    <article class="profile">

        <section class="profile-section">

            <div class="profile-icon-container">

                <img src="../../../images/profileicon.png" alt="Profile Icon" class="profie-icon-img">

            </div>

            <div class="profile-username-container">

                <p class="profile-username-text section-text">

                    Full Name: <span id="name-span"><?php echo $_SESSION["customer"]["name"] ?></span>

                </p>

            </div>

            <div class="profile-model-container">

                <p class="profile-model-text section-text">
                    Model:    
                    <span class="model-span">
                        <?php

                        $full_name = $_SESSION["customer"]["name"];

                        $select_model_query = "SELECT model FROM `customer` WHERE full_name = '$full_name'";
                        
                        $model = mysqli_query($conn, $select_model_query);

                        if($row = mysqli_fetch_assoc($model)){
                            echo $row['model'];
                        }else{
                            echo "Null";
                        };

                        ?>
                    </span>

                </p>

            </div>

            <div class="profile-contactnumber-container">
                        
                <p class="profile-contactnumber-text section-text">
                    Contact Number:
                    <?php 
                        $full_name = $_SESSION["customer"]["name"];

                        $select_contactnumber_query = "SELECT phone_number FROM `customer` WHERE full_name = '$full_name'";

                        $contact_number = mysqli_query($conn, $select_contactnumber_query);

                        if($row = mysqli_fetch_assoc($contact_number)){
                            echo $row['phone_number'];
                        }else{
                            echo "Null";
                        }

                    ?>

                </p>

            </div>

        </section>

        <section class="edit-section">

            <div class="profile-edit-button">

                <button class="editbtn"><a href="./edit-profile.php">Edit Profile Details</a></button>

            </div>

            <div class="profile-change-password-button">

                <button class="changepswbtn"><a href="./change-password.php">Change Password</a></button>

            </div>

        </section>

    </article>

</body>
</html>
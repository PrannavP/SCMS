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
    <title>Suggestion & Issues</title>
    <link rel="stylesheet" href="../../../styles/customer-suggestion-issue.css">
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

                    <li class="nav-item nav-spare_parts"><a href="../customer-spare-parts/customer-spare-parts.php">Spare Parts</a></li>

                    <li class="nav-item nav-suggestion_issue active"><a href="../customer-suggestion-issue/customer-suggestion-issue.php">Suggestion / Issues</a></li>

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

    <article class="suggestion_issue-section">

		<h2>Suggestion / Issues</h2>

		<div class="section-title">

            <h4>If you have any suggestions or complaints regarding the service center, then please feel free to tell us.</h4>

        </div>

        <div class="form-section">

            <form action="./send-message.php" method="post">

                <div class="name-field">

                    <label for="name">Full Name</label><br>

                    <input type="text" name="full_name" id="full_name">

                </div>

                <div class="email_phone-field">

                    <label for="email_phone">Email / Phone</label><br>

                    <input type="text" name="email_phone" id="email_phone">

                </div>  

                <div class="service_center-field">

                    <label for="service_center">Service Center</label><br>

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

                <div class="message-field">

                    <label for="message">Message</label><br>

                    <textarea name="message" id="message" cols="40" rows="5"></textarea>

                </div>

                <div class="submit-field">

                    <button class="submit-button">Send</button>

                </div>

            </form>

        </div>

	</article>
    
</body>
</html>
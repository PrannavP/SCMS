<?php

    require '../../middlewares/connection.php';
    require_once '../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isCustomerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ./customer-login.php");
        exit();
    }

    // getting user infos from database
    $user_fullname = $_SESSION['customer']['name'];

    $sql_query = "SELECT `model` FROM `customer` WHERE full_name = '$user_fullname'";
    $result = mysqli_query($conn, $sql_query);

    $data = mysqli_fetch_assoc($result);

    $model = $data['model']; // returns model of scooter or bike

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
    <link rel="stylesheet" href="../../styles/customer-dashboard.css">
</head>
<body>

    <header>

        <h3>Welcome, <?php echo $_SESSION["customer"]["name"] ?></h3>

        <p id="time"></p>

        <a href="#">Settings</a>

    </header>

    <div class="request-service">

        <form action="" method="post">

            <h4 class="form-title">Request Servicing</h4>

            <div class="fullname">

                <label for="email">Full Name:</label><br>
                <input type="text" name="fname" id="fname" required>

            </div>

            <div class="email">

                <label for="email">Email:</label><br>
                <input type="email" name="email" id="email" required>

            </div>

            <div class="phonenumber">

                <label for="pnumber">Contact Number:</label><br>
                <input type="number" name="pnumber" id="pnumber" required>

            </div>

            <div class="model">

                <label for="model">Model:</label><br>
                <input type="text" name="model" id="model" value="<?php echo $model ?>" disabled required>

            </div>

            <div class="requestdate">

                <label for="date">Preferred Date:</label><br>
                <input type="date" name="date" id="date"  required>

            </div>

            <div class="pickup">

                <label for="pickup-chkbox">Pickup: </label><br>
                <input type="checkbox" name="pickup" id="pickup-chkbox">

            </div>

            <div class="delivery">

                <label for="delivery-chkbox">Delivery: </label><br>
                <input type="checkbox" name="delivery" id="delivery-chkbox">

            </div>

            <div class="pickup-address">

                <label for="pickup-address">Pickup Address: </label><br>
                <input type="text" name="pickup-address" id="pickup-address" disabled>

            </div>

            <div class="delivery-address">

                <label for="delivery-address">Delivery Address: </label><br>
                <input type="text" name="delivery-address" id="delivery-address" disabled>

            </div>

            <center><button id="manager-login" name="manager-login">Request</button></center>

        </form>

    </div>

    <!-- linking script file -->
    <script src="../../scripts/timer.js"></script>
    <script src="../../scripts/customer-dashboard.js"></script>

</body>
</html>
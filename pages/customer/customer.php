<?php

    require '../../middlewares/connection.php';
    require_once '../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isCustomerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ./customer-login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Dashboard</title>
</head>
<body>

    <p><?php echo $_SESSION["user_type"] ?></p>
    <p><?php echo $_SESSION["customer"]["name"] ?></p>
    <a href="../../middlewares/logout.php">Logout</a>
    
</body>
</html>
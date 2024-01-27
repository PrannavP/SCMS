<?php

    require '../../middlewares/connection.php';
    require_once '../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isUserAuthenticated()) {
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
</head>
<body>

    <p><?php echo $_SESSION["name"] ?></p>
    <button><a href="../../middlewares/logout.php">Logout</a></button>
    
</body>
</html>
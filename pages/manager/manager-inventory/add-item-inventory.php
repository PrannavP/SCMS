<?php

    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    }

    echo "Add Item Page";

    function addItem($conn){
        $part_number = $_POST['partnumber'];
        $part_name = $_POST['partname'];
        $part_quantity = $_POST['partquantity'];
        $part_price = $_POST['partprice'];

        $sql_query_to_add_item = "INSERT INTO `inventory`(`item_number`, `item_name`, `item_quantity`, `item_price`) VALUES ('$part_number','$part_name','$part_quantity','$part_price')";

        mysqli_query($conn, $sql_query_to_add_item);

        header("Location: manager-inventory.php");
    };

    addItem($conn);

?>
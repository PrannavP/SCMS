<?php
  
    require '../../../middlewares/connection.php';
    require_once '../../../middlewares/checkAuth.php';

    // Check if the user is authenticated
    if (!isManagerAuthenticated()) {
        // Redirect to the login page or display a message
        header("Location: ../../index.html");
        exit();
    };

    $id = $_GET['request_id'];

    // function to update servicing details
    function updateServicingDetails($connection, $request_id){
        $sql_query_to_update_details = "UPDATE `service_request` SET `servicing_status` = 'Completed Servicing' WHERE `request_id` = '$request_id'";

        mysqli_query($connection, $sql_query_to_update_details);
    };

    updateServicingDetails($conn, $id);


    // function to generate report and store it in billing table
    function generateReports($connection, $request_id){
        $sql_query_to_generate_report = "INSERT INTO `billings` (`customer_name`, `amount`, `parts`, `serviced_by`, `status`, `service_center`) SELECT `requested_by`, `amount`, `parts`, `mechanic_assigned`, `servicing_status`, `service_center` FROM `service_request` WHERE `request_id` = '$request_id'";

        mysqli_query($connection, $sql_query_to_generate_report);
    };

    generateReports($conn, $id);

    function increaseAvailableServicingSlot($connection){
        $service_center = $_SESSION["manager"]["service-center"];

        $sql_query_to_increase_slot = "UPDATE `servicecenter` SET `available_slots` = `available_slots` + 1 WHERE `name` = '$service_center'";

        mysqli_query($connection, $sql_query_to_increase_slot);
    };

    increaseAvailableServicingSlot($conn);

    header("Location: manager-service-requests.php");

?>
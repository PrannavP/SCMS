<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "scms";

    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if (isset($_POST['service_request_id']) && isset($_POST['parts'])) {
        $serviceRequestId = mysqli_real_escape_string($conn, $_POST['service_request_id']);
        $parts = $_POST['parts'];

        // Insert new parts
        $insertSql = "INSERT IGNORE INTO service_request (service_request_id, part_id) VALUES ";
        $values = [];

        foreach ($parts as $partId) {
            $partId = mysqli_real_escape_string($conn, $partId);
            $values[] = "('$serviceRequestId', '$partId')";
        }

        $insertSql .= implode(',', $values);

        if (mysqli_query($conn, $insertSql)) {
            echo "New records added successfully";
        } else {
            echo "Error: " . $insertSql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>
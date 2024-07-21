<?php
    header('Content-Type: application/json');

    $conn = mysqli_connect("localhost", "root", "", "scms");

    if (!$conn) {
        die(json_encode(array("error" => "Connection failed: " . mysqli_connect_error())));
    }

    $data = json_decode(file_get_contents('php://input'), true);
    $requested_by = mysqli_real_escape_string($conn, $data['requested_by']);

    $sql = "SELECT parts FROM service_request WHERE requested_by = '$requested_by'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        echo json_encode(array(
            "parts" => $row['parts']
        ));
    } else {
        echo json_encode(array("error" => "No data found"));
    }

    mysqli_close($conn);
?>
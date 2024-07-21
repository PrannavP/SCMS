<?php
    $conn = mysqli_connect("localhost", "root", "", "scms");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT requested_by FROM service_request WHERE servicing_status = 'Pending Servicing';";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['requested_by'] . "'>" . $row['requested_by'] . "</option>";
    }

    mysqli_close($conn);
?>
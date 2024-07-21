<?php
    $conn = mysqli_connect("localhost", "root", "", "scms");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT item_name FROM inventory";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['item_name'] . "'>" . $row['item_name'] . "</option>";
    }

    mysqli_close($conn);
?>
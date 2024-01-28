<?php
    require './connection.php';

    // login function
    function manager_login($conn) {
        $email = $_POST["email"];
        $password = $_POST["psw"];

        // sql query
        $sql = "SELECT fullname FROM manager WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // starting session
            session_start();

            $_SESSION = array(); // Clear existing session data
            $_SESSION["user_type"] = "manager";
            $_SESSION["manager"]["name"] = $row["fullname"];
            $_SESSION["manager"]["auth"] = true;

            // redirect to manager dashboard
            header("Location: ../pages/manager/dashboard.php");
        } else {
            echo "<p>Incorrect details.</p>";
            header("refresh:3, URL= ../index.html");
        }
    }

    function customer_login($conn) {
        $email = $_POST["email"];
        $password = $_POST["psw"];

        // sql query
        $sql = "SELECT full_name from customer WHERE email = '$email' and password = '$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // fetching data from sql
            $row = mysqli_fetch_assoc($result);

            // starting session
            session_start();
            
            $_SESSION = array(); // Clear existing session data
            $_SESSION["user_type"] = "customer";
            $_SESSION["customer"]["name"] = $row['full_name'];
            $_SESSION["customer"]["auth"] = true;

            // redirect to customer dashboard
            header("Location: ../pages/customer/customer.php");
        } else {
            echo "<p>Incorrect customer details</p>";
            header("refresh:3, URL=../pages/customer/customer-login.php");
        }
    }

    if (isset($_POST['manager-login'])) {
        manager_login($conn);
    } elseif (isset($_POST["customer-login"])) {
        customer_login($conn);
    }
?>
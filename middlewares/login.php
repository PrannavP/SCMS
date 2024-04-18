<?php
    require './connection.php';

    // login function
    function manager_login($conn) {
        $email = $_POST["email"];
        $password = $_POST["psw"];

        // sql query
        $sql = "SELECT fullname, service_center FROM manager WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // starting session
            session_start();

            $_SESSION = array(); // Clear existing session data
            $_SESSION["user_type"] = "manager";
            $_SESSION["manager"]["name"] = $row["fullname"];
            $_SESSION["manager"]["auth"] = true;
            $_SESSION["manager"]["service-center"] = $row["service_center"];

            // redirect to manager dashboard
            header("Location: ../pages/manager/dashboard/dashboard.php");
        } else {
            // echo "<p>Incorrect details.</p>";
            // header("refresh:3, URL= ../index.html");
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
            $_SESSION["customer"]["email"] = $email;
            $_SESSION["customer"]["auth"] = true;

            // redirect to customer dashboard
            header("Location: ../pages/customer/dashboard/customer.php");
        } else {
            echo "<p>Incorrect customer details</p>";
            header("refresh:3, URL=../pages/customer/customer-login.php");
        }
    }

    // admin login

    function admin_login($conn){
        $admin_email = $_POST["email"];
        $admin_password = $_POST["psw"];

        // sql query
        $sql_query_to_admin_login = "SELECT `type` FROM `admin` WHERE email = '$admin_email' AND password = '$admin_password'";
        $result = mysqli_query($conn, $sql_query_to_admin_login);

        if($result && mysqli_num_rows($result) > 0){
            // fetching data from sql
            $row = mysqli_fetch_assoc($result);

            // starting session
            session_start();

            $_SESSION = array();
            $_SESSION["user_type"] = "admin";
            $_SESSION["admin"]["name"] = "Admin";
            $_SESSION["admin"]["email"] = $row["email"];
            $_SESSION["admin"]["auth"] = true;

            // redirect to admin dashboard
            header("Location: ../pages/admin/dashboard/admin-dashboard.php");
        }else{
            echo "<p>Incorrect admin details</p>";
            // header("Location: ../pages/admin/admin-login.html");
        };
    };

    if (isset($_POST['manager-login'])) {
        manager_login($conn);
    } elseif (isset($_POST["customer-login"])) {
        customer_login($conn);
    }elseif (isset($_POST["admin-login"])){
        admin_login($conn);
    }
?>
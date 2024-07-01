<?php

    require './connection.php';

    // login function
    function manager_login($conn){
        $email = $_POST["email"];
        $password = $_POST["psw"];

        function login_manager_validation($email, $password, $conn){
            $pattern = '/@servease\.com\.np$/';

            // Login form validation
            if(strlen($password) == 0 || strlen($email) == 0){
                echo "All the fields are required";
                header("Location: ../index.html");
            }elseif(!preg_match($pattern, $email)){
                echo "Invalid email manager email format.";
                header("Location: ../index.html");
            }
        };

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
        }else{
            login_manager_validation($email, $password, $conn);
        }
    };

    function customer_login($conn) {
        $email = $_POST["email"];
        $password = $_POST["psw"];
        
        function login_customer_validation($email, $password){
            if(strlen($email) == 0 || strlen($password) == 0){
                echo "All fields are required";
                header("Location: ../pages/customer/customer-login.php");
                exit();
            };
        };

        login_customer_validation($email, $password);

        // SQL query to get the hashed password from the database
        $sql = "SELECT `full_name`, `email`, `password` FROM customer WHERE `email` = '$email'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            // Fetching data from SQL
            $row = mysqli_fetch_assoc($result);
            $hashed_password = $row['password'];

            echo "Passed first if statement";

            // test
            $isPasswordVerified = password_verify($password, $hashed_password);
            var_dump($isPasswordVerified);

            // Verify the password
            if($isPasswordVerified) {
                echo "Passed second if statement";
                // Starting session
                session_start();
                
                $_SESSION = array(); // Clear existing session data
                $_SESSION["user_type"] = "customer";
                $_SESSION["customer"]["name"] = $row['full_name'];
                $_SESSION["customer"]["email"] = $email;
                $_SESSION["customer"]["auth"] = true;

                // Redirect to customer dashboard
                header("Location: ../pages/customer/dashboard/customer.php");
                exit();
            } else {
                echo "<p>Incorrect customer details</p>";
                echo "error";
                header("refresh:3, URL=../pages/customer/customer-login.php");
            }
        };
    };

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
<?php

    require './connection.php';

    // login function
    function login($conn){
        $email = $_POST["email"];
        $password = $_POST["psw"];

        // sql query
        $sql = "SELECT fullname FROM manager WHERE email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if($result && mysqli_num_rows($result) > 0){
            // starting session if user exists
            session_start();

            $row = mysqli_fetch_assoc($result);

            // storing name in session
            $_SESSION["name"] = $row["fullname"];

            // setting auth to true
            $_SESSION["auth"] = true;

            // redirect to manager dashboard
            header("Location: ../pages/manager/dashboard.php");
        }else{
            echo "<p>Incorrect details.</p>";
            header("refresh:3, URL= ../index.html");
        };
    };

    if(isset($_POST['login'])){
        login($conn);
    };
?>
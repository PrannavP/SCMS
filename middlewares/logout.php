<?php

    session_start();

    $user_type = $_SESSION["user_type"];

    if ($user_type === "manager") {
        $_SESSION['manager']['auth'] = false;
        header('Location: ../index.html');
        exit();
    } elseif ($user_type === "customer") {
        $_SESSION['customer']["auth"] = false;
        header('Location: ../pages/customer/customer-login.php');
        exit();
}
?>
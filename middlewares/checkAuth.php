<?php
    session_start();

    // Function to check if the manager is authenticated
    function isManagerAuthenticated() {
        if (isset($_SESSION['manager']['auth']) && $_SESSION['manager']['auth'] === true) {
            return true;
        } else {
            return false;
        };
    };

    // Function to check if customer is authenticated
    function isCustomerAuthenticated(){
        if(isset($_SESSION['customer']["auth"]) && $_SESSION['customer']["auth"] === true){
            return true;
        }else{
            return false;
        };
    };
?>

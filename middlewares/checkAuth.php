<?php
    session_start();

    // Function to check if the user is authenticated
    function isUserAuthenticated() {
        if (isset($_SESSION['auth']) && $_SESSION['auth'] === true) {
            return true;
        } else {
            return false;
        }
    }
?>

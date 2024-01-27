<?php

    session_start();
    
    // changing auth to false
    $_SESSION["auth"] = false;

    // redirecting to index
    header("Location: ../index.html");

?>
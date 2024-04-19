<?php

        // function that generates random digit
    function generateDigit($length = 6) {
        return substr(str_shuffle(str_repeat($x='0123456789', ceil($length/strlen($x)) )),1,$length);
    };

    // generateDigit();

?>
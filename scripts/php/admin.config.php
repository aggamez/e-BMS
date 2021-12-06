<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbase = "ebims";

    $aconn = new mysqli($server, $user, $pass, $dbase) or die(mysqli_error($aconn));
?>
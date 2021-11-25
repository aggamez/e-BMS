<?php
    $server = "localhost";
    $user = "root";
    $pass = "";
    $dbase = "accounts";

    $dconn = new mysqli($server, $user, $pass, $dbase) or die(mysqli_error($dconn));
?>
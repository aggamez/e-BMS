<?php
    include "config.php";
    include "admin.config.php";

    if(isset($_POST['delete'])){
        $id = $_POST['id'];

        if($id == 0){
        }else{
            $dconn -> query("DELETE from data WHERE id = '$id'") or die($dconn -> error);

            echo "<script>
                alert('Account deleted!');
                window.location.replace('datalog.php');
            </script>";
        }
    }  

    if(isset($_POST['close'])){
            echo "<script>
                window.location.replace('datalog.php');
            </script>";
    } 
     
    
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $studNumb = $_POST['studNumber'];
        $yearLvl = $_POST['yearLevel'];
        $program = $_POST['program'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $sex = $_POST['sex'];
        $date = $_POST['datemax'];
        $pass = $_POST['pass'];

        $userChecker = $dconn -> query("SELECT * FROM data WHERE id = '$id'")or die($dconn -> error);
        $userValidator = $userChecker -> fetch_assoc();

        if($firstName != $userValidator['firstName']){
            $dconn -> query("UPDATE data SET firstName = '$firstName' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($lastName != $userValidator['lastName']){
            $dconn -> query("UPDATE data SET lastName = '$lastName' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($studNumb != $userValidator['studNumber']){
            $dconn -> query("UPDATE data SET studNumber = '$studNumb' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($yearLvl != $userValidator['yearLevel']){
            $dconn -> query("UPDATE data SET lastName = '$yearLvl' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($program != $userValidator['program']){
            $dconn -> query("UPDATE data SET program = '$program' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($email != $userValidator['email']){
            $dconn -> query("UPDATE data SET email = '$email' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($contact != $userValidator['contactNumber']){
            $dconn -> query("UPDATE data SET contactNumber = '$contact' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($sex != $userValidator['sex']){
            $dconn -> query("UPDATE data SET sex = '$sex' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($date != $userValidator['birthDate']){
            $dconn -> query("UPDATE data SET birthDate = '$date' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($pass != $userValidator['pass']){
            $dconn -> query("UPDATE data SET pass = '$pass' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        echo "<script>
                alert('Values edited!');
                window.location.replace('datalog.php');
        </script>";

    } 
    
    if(isset($_POST['admin-log'])){
        $user = $_POST['admin-user'];
        $pass = $_POST['admin-pass'];

        $admin = $aconn -> query("SELECT * from admins WHERE username ='$user'") or die(mysqli_error($aconn));
        $adminChecker = $admin -> fetch_assoc();

        if ($adminChecker['username'] == $user){
            if ($adminChecker['pass'] == $pass){
                echo "<script>
                    alert('Logged in');
                    window.location.replace('datalog.php');
                </script>";
            }else{
                echo "<script>
                    alert('Wrong Password!');
                    window.location.replace('dataver.php');
                </script>";
            }
        }else{
            echo "<script>
                    alert('Username invalid');
                    window.location.replace('dataver.php');
                </script>";
        }
} 
     
?>

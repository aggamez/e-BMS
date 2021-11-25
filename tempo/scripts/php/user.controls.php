<?php
    include 'config.php';

    if (isset($_POST['register'])){
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $studNumb = $_POST['studNumber'];
        $yearLvl = $_POST['yearLevel'];
        $program = $_POST['program'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $sex = $_POST['sex'];
        $date = $_POST['datemax'];
        $dateArr = explode("-", $date);
        $year = $dateArr[0];
        $month = $dateArr[1];
        $day = $dateArr[2];
        $password = strtolower($lastName) . $month . $day . $year;

        $userChecker = $dconn -> query("SELECT id, studNumber FROM data WHERE studNumber = '$studNumb'")or die($dconn -> error);

        if($userChecker -> num_rows > 0){
            echo "<script>alert('Student Number used!') </script>";
        } else{
             $dconn -> query("INSERT INTO data (firstName, lastName, studNumber, yearLevel, program, email, contactNumber, sex, birthDate, pass)  
                            VALUES('$firstName', '$lastName', '$studNumb', '$yearLvl', '$program', '$email', '$contact', '$sex', '$date', '$password') ")
                            or die($dconn -> error);

            echo    "<script>
                        alert('Success! Your Password is ".$password." .');
                        window.location.href='./login.php';
                    </script>";
            }
    }

    if (isset($_POST['forgot'])){
        $studNumb = $_POST['studNumber'];
        $pass = $_POST['pass'];

        $userChecker = $dconn -> query("SELECT * FROM data WHERE studNumber = '$studNumb'")or die($dconn -> error);
        $userValidator = $userChecker -> fetch_assoc();

        
        if($pass != $userValidator['pass']){
            $dconn -> query("UPDATE data SET pass = '$pass' WHERE studNumber = '$studNumb'")or die($dconn -> error);
        }else{
        }


        echo    "<script>
                    alert('Success! Your Password is ".$pass." .');
                    window.location.href='./login.php';
                </script>";
    }

    if(isset($_POST['log-in'])){
        $user = $_POST['studNumber'];
        $pass = $_POST['pass'];

        $data = $dconn -> query("SELECT * from data WHERE studNumber ='$user'") or die($dconn -> error);
        $dataChecker = $data -> fetch_assoc();

        if ($dataChecker['studNumber'] == $user){
            if ($dataChecker['pass'] == $pass){
                session_start();

                $id = $dataChecker['id'];
                $_SESSION['id'] = $id;

                echo "<script>
                    alert('Logged in');
                    window.location.replace('userpage.php');
                </script>";
            }else{
                echo "<script>
                    alert('Wrong Password!');
                    window.location.replace('login.php');
                </script>";
            }
        }else{
            echo "<script>
                    alert('Invalid Credentials!');
                    window.location.replace('login.php');
                </script>";
        }
    }
    
    if (isset($_POST['log-off'])){
        session_destroy();
        echo    "<script>
                    alert('Logged out.');
                    window.location.href='login.php';
                </script>";
    }

    if(isset($_POST['close'])){
        echo "<script>
            window.location.replace('userpage.php');
        </script>";
    }
    
    if(isset($_POST['edit'])){
        $id = $_POST['id'];
        $yearLvl = $_POST['yearLevel'];
        $program = $_POST['program'];
        $email = $_POST['email'];
        $contact = $_POST['contact'];
        $sex = $_POST['sex'];
        $pass = $_POST['pass'];

        $userChecker = $dconn -> query("SELECT * FROM data WHERE id = '$id'")or die($dconn -> error);
        $userValidator = $userChecker -> fetch_assoc();

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

        if($pass != $userValidator['pass']){
            $dconn -> query("UPDATE data SET pass = '$pass' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        session_start();
        $_SESSION['id'] = $id;

        echo "<script>
                alert('Values edited!');
                window.location.replace('userpage.php');
        </script>";

    } 

    if(isset($_POST['delete'])){
        $id = $_POST['id'];

        if($id == 0){
        }else{
            $dconn -> query("DELETE from data WHERE id = '$id'") or die($dconn -> error);

            echo "<script>
                alert('Account deleted!');
                window.location.replace('login.php');
            </script>";
        }
    }  
?>
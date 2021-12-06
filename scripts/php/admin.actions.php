<?php
    include "admin.config.php";
    date_default_timezone_set('Asia/Manila');

    if(isset($_POST['acceptAdmin'])){
        $accName = "admin";

        $accPass = "admin01234";

        $dateTime = date("Y-m-d H:i:s");
        $dateTimeParts = explode(" ", $dateTime);

        $dateParts = explode("-", $dateTimeParts[0]);
        $year = $dateParts[0];
        $month = $dateParts[1];
        $day = $dateParts[2];

        $timeParts = explode(":", $dateTimeParts[1]);
        $hour = $timeParts[0];
        $min = $timeParts[1];
        $sec = $timeParts[2];

        $nameSlice = substr($accName, 0, 2);

        //16-character ID uniquely made with date and time of creation and first 2 account name
        $accID = $nameSlice . $year . $month . $day . $hour . $min . $sec;

        

        //Salt = add more security to password, implemented both before and after password string
        //1st, 3rd, 4th, 7th, 9th,and 10th character of the id, and add year again
        $charaOne = substr($accID, 0, 1);
        $charaTri = substr($accID, 2, 1);
        $charaQua= substr($accID, 3, 1);
        $charaSev = substr($accID, 6, 1);
        $charaNin = substr($accID, 8, 1);
        $charaTen = substr($accID, 9, 1);
        $salt = $charaOne . $charaTri . $charaQua . $charaSev . $charaNin . $charaTen . $year;

        $passPart = $salt . $accPass . $salt;
        $accPassHash = hash('md5', $passPart);

        $aconn -> query("INSERT INTO admin (adminID, adminName, passwordHash, adminDate)  
            VALUES('$accID', '$accName', '$accPassHash', '$dateTime') ")
            or die($aconn -> error);

    

        echo    "<script>
                window.alert('Admin Account Created');
                window.location.href = 'login.php';
                </script>";

    }  

    if(isset($_POST['log-in'])){
        $username = $_POST['acct'];
        $password = $_POST['pass'];

        $userCheck = $aconn -> query("SELECT * from admin WHERE adminName ='$username'") or die(mysqli_error($aconn));
        $checker = $userCheck -> fetch_assoc();

        $dateTime = $checker['adminDate'];
        $dateTimeParts = explode(" ", $dateTime);

        $dateParts = explode("-", $dateTimeParts[0]);
        $year = $dateParts[0];

        //16-character ID uniquely made with date and time of creation and first 2 account name
        $accID = $checker['adminID'];

        $passCheck = $checker['passwordHash'];

        //Salt = add more security to password, implemented both before and after password string
        //1st, 3rd, 4th, 7th, 9th,and 10th character of the id, and add year again
        $charaOne = substr($accID, 0, 1);
        $charaTri = substr($accID, 2, 1);
        $charaQua= substr($accID, 3, 1);
        $charaSev = substr($accID, 6, 1);
        $charaNin = substr($accID, 8, 1);
        $charaTen = substr($accID, 9, 1);
        $salt = $charaOne . $charaTri . $charaQua . $charaSev . $charaNin . $charaTen . $year;

        $passPart = $salt . $password . $salt;
        $truePass = hash('md5', $passPart);

        echo    "<script>
                    console.log('$accID');
                    console.log('$passCheck');
                    console.log('$dateTime');
                    console.log('$truePass');
                </script>";

        if($truePass == $passCheck){
            echo    "<script>
                    window.alert('Logged In');
                    window.location.href = 'dashboard.php';
                    </script>";
        } else {
            echo    "<script>
                    window.alert('Invalid Password');
                    window.location.href = 'login.php';
                    </script>";
        }

    }  
?>
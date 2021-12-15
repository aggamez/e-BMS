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
        
        if($userCheck -> num_rows > 0) {
            $checker = $userCheck -> fetch_assoc();

            $dateTime = $checker['adminDate'];
            $dateTimeParts = explode(" ", $dateTime);

            $dateParts = explode("-", $dateTimeParts[0]);
            $year = $dateParts[0];

            $accID = $checker['adminID'];
            $passCheck = $checker['passwordHash'];

            $charaOne = substr($accID, 0, 1);
            $charaTri = substr($accID, 2, 1);
            $charaQua= substr($accID, 3, 1);
            $charaSev = substr($accID, 6, 1);
            $charaNin = substr($accID, 8, 1);
            $charaTen = substr($accID, 9, 1);
            $salt = $charaOne . $charaTri . $charaQua . $charaSev . $charaNin . $charaTen . $year;

            $passPart = $salt . $password . $salt;
            $truePass = hash('md5', $passPart);
            
            if($truePass == $passCheck){
                echo    "<script>
                        window.alert('Logged In');
                        window.location.href = 'dashboard.main.php';
                        </script>";
            } else {
                echo    "<script>
                        window.alert('Invalid Password');
                        window.location.href = 'login.php';
                        </script>";
            }
        } else{
            echo    "<script>
                        window.alert('Invalid Username');
                        window.location.href = 'login.php';
                    </script>";
        }
        
        setcookie('admin', $username, time() + (86400 *30), "/");

    }  


    if(isset($_POST['addPurok'])){
        $purokName = $_POST['purokName'];
        $purokName = strtoupper($purokName);

        $purokCheck = $aconn -> query("SELECT * from purok  WHERE name ='$purokName'") or die(mysqli_error($aconn));
        $purok = $aconn -> query("SELECT COUNT(id) as total from purok") or die(mysqli_error($aconn));
        $purokCount = $purok -> fetch_assoc();
        $purokCount = $purokCount['total'];
        $purokCount = $purokCount + 1;
        if ($purokCount < 10){
            $purokCount = '0' . $purokCount;
        }


        $ID = substr($purokName, 0, 3) . $purokCount;
        
        if($purokCheck -> num_rows > 0) {
            echo    "<script>
                        window.alert('Purok in Database!');
                        window.location.href = 'dashboard.adconfig.php';
                    </script>";
        } else {
            $aconn -> query("INSERT INTO purok(ID, name)  
            VALUES('$ID', '$purokName') ")
            or die($aconn -> error);

            echo    "<script>
                    window.alert('Purok Added');
                    window.location.href = 'dashboard.adconfig.php';
                    </script>";

        }
    }  

    if(isset($_POST['editPurok'])){
        $purokName = $_POST['name'];
        $purokID = $_POST['id'];
        $purokName = strtoupper($purokName);

        $purok = $aconn -> query("SELECT * from purok  WHERE name ='$purokName'") or die(mysqli_error($aconn));
        $purokCount = $purok -> fetch_assoc();
        $purokNum =  substr($purokID, 3, 5);


        $ID = substr($purokName, 0, 3) . $purokNum;
        
        if($purok -> num_rows > 0) {
            echo    "<script>
                        window.alert('Purok in Database!');
                        window.location.href = 'dashboard.adconfig.php';
                    </script>";
        } else {
            $aconn -> query("UPDATE purok SET name = '$purokName' WHERE id = '$purokID'")or die($aconn -> error);
            $aconn -> query("UPDATE purok SET id = '$ID' WHERE id = '$purokID'")or die($aconn -> error);
            

            echo    "<script>
                        window.alert('Changed data');
                        window.location.href = 'dashboard.adconfig.php';
                    </script>";
        }
    } 

    if(isset($_POST['deletePurok'])){
        $purokID = $_POST['id'];
        echo "<script>
                console.log(<?php echo $purokID ?>);
            </script>";

        $aconn -> query("DELETE from purok WHERE id = '$purokID'") or die($aconn -> error);

            echo "<script>
                alert('Purok deleted!');
                window.location.replace('dashboard.adconfig.php');
            </script>";
    }  


    if(isset($_POST['addPosition'])){
        $posName = $_POST['posName'];
        $posName = strtoupper($posName);

        $posCheck = $aconn -> query("SELECT * from positions WHERE name ='$posName'") or die(mysqli_error($aconn));
        $pos = $aconn -> query("SELECT COUNT(id) as total from positions") or die(mysqli_error($aconn));
        $posCount = $pos -> fetch_assoc();
        $posCount = $posCount['total'];
        $posCount = $posCount + 1;
        if ($posCount < 10){
            $posCount = '0' . $posCount;
        }


        $ID = substr($posName, 0, 3) . $posCount;
        
        if($posCheck -> num_rows > 0) {
            echo    "<script>
                        window.alert('Position in Database!');
                        window.location.href = 'dashboard.adconfig.php';
                    </script>";
        } else {
            $aconn -> query("INSERT INTO positions(ID, name)  
            VALUES('$ID', '$posName') ")
            or die($aconn -> error);

            echo    "<script>
                    window.alert('Position Added');
                    window.location.href = 'dashboard.adconfig.php';
                    </script>";

        }
    }  

    if(isset($_POST['confBarangay'])){
        $brgyName = $_POST['brgyName'];
        $brgyAddr = $_POST['brgyAddr'];

        $xml = simplexml_load_file("configure.xml") or die("Error: Cannot create object");

        $xml -> name = $brgyName;
        $xml -> address = $brgyAddr;

        $xml -> asXML("configure.xml");

        
        echo    "<script>
                window.alert('Edit Complete');
                window.location.href = 'dashboard.adconfig.php';
                </script>";

    }
    
    if(isset($_POST['confBarangay'])){
        $brgyName = $_POST['brgyName'];
        $brgyAddr = $_POST['brgyAddr'];

        $xml = simplexml_load_file("configure.xml") or die("Error: Cannot create object");

        $xml -> name = $brgyName;
        $xml -> address = $brgyAddr;

        $xml -> asXML("configure.xml");

        
        echo    "<script>
                window.alert('Edit Complete');
                window.location.href = 'dashboard.adconfig.php';
                </script>";

    }
    
    if(isset($_POST['confProfile'])){
        $target_dir = "image/";
        $fileName = $target_dir . "logo.png";
        $target_file = $target_dir . basename($_FILES["logoFile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["logoFile"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["logoFile"]["size"] > 50000000){
        echo    "<script>
        window.alert('Sorry, your file is too large.);
        window.location.href = 'dashboard.adconfig.php';
        </script>";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "png") {
        echo    "<script>
        window.alert('Sorry, only PNG files are allowed.');
        window.location.href = 'dashboard.adconfig.php';
        </script>";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo    "<script>
                window.alert('Upload Incomplete!');
                window.location.href = 'dashboard.adconfig.php';
                </script>";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["logoFile"]["tmp_name"], $fileName )) {
            echo    "<script>
                window.alert('Edit Complete');
                window.location.href = 'dashboard.adconfig.php';
                </script>";
        } else {
            echo    "<script>
                window.alert('Error Editing!');
                window.location.href = 'dashboard.adconfig.php';
                </script>";
        }
        }

    }

    if(isset($_POST['confSplash'])){
        $target_dir = "image/";
        $fileName = $target_dir . "splash.png";
        $target_file = $target_dir . basename($_FILES["spshFile"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["spshFile"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["spshFile"]["size"] > 50000000){
        echo    "<script>
        window.alert('Sorry, your file is too large.);
        window.location.href = 'dashboard.adconfig.php';
        </script>";
        $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "png" && $imageFileType != "jpg" && $imageFileType != "jpeg") {
        echo    "<script>
        window.alert('Sorry, only PNG files are allowed.');
        window.location.href = 'dashboard.adconfig.php';
        </script>";
        $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
        echo    "<script>
                window.alert('Upload Incomplete!');
                window.location.href = 'dashboard.adconfig.php';
                </script>";
        // if everything is ok, try to upload file
        } else {
        if (move_uploaded_file($_FILES["spshFile"]["tmp_name"], $fileName )) {
            echo    "<script>
                window.alert('Edit Complete');
                window.location.href = 'dashboard.adconfig.php';
                </script>";
        } else {
            echo    "<script>
                window.alert('Error Editing!');
                window.location.href = 'dashboard.adconfig.php';
                </script>";
        }
        }

    }


    if(isset($_POST['addResident'])){
        $familyName = $_POST['familyName'];
        $givenName = $_POST['givenName'];
        $middleName = $_POST['middleName'];
        $alias = $_POST['alias'];
        $faceMarks = $_POST['faceMarks'];
        $birthDate = $_POST['birthDate'];
        $birthPlace = $_POST['birthPlace'];
        $sex = $_POST['sex'];
        $civilStatus = $_POST['civilStatus'];
        $nationality = $_POST['nationality'];
        $faith = $_POST['faith'];
        $occupation = $_POST['occupation'];
        $sector = $_POST['sector'];
        $spouseName = $_POST['spouseName'];
        $spouseOccu = $_POST['spouseOccu'];
        $voterState = $_POST['voterState'];
        $cityAdd = $_POST['cityAdd'];
        $provAdd = $_POST['provAdd'];
        $purok = $_POST['purok'];
        $homeNumbOne = $_POST['homeNumbOne'];
        $homeNumbTwo = $_POST['homeNumbTwo'];
        $mobiNumbOne = $_POST['mobiNumbOne'];
        $mobiNumbTwo = $_POST['mobiNumbTwo'];
        $email = $_POST['email'];
        $resType = $_POST['resType'];
        $resState = $_POST['resState'];

        if($spouseName == null || $spouseName == ""){
            $spouseName = "N/A";
        }

        if($spouseOccu == null || $spouseOccu == ""){
            $spouseOccu = "N/A";
        }

        $processedBy = $_COOKIE['admin'];

        $dateTime = new DateTime();
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        $dateTimeParts = explode(" ", $dateTime);

        $dateParts = explode("-", $dateTimeParts[0]);
        $year = $dateParts[0];
        $month = $dateParts[1];
        $day = $dateParts[2];

        $timeParts = explode(":", $dateTimeParts[1]);
        $hour = $timeParts[0];
        $minute = $timeParts[1];
        $second = $timeParts[2];




        $transactionID = $year . $month . $day . $hour . $minute . $second;


        $resiCheck = $aconn -> query("SELECT * from residents") or die(mysqli_error($aconn));
        if ($resiCheck -> num_rows > 0){
            $idCheck = $aconn -> query("SELECT MAX(id) as high from residents") or die(mysqli_error($aconn));

            $idCount = $idCheck -> fetch_assoc();
            $id = $idCount['high'];
            $id = $id + 1;


        } else{
            $id = $year . "0001";
        }

        $target_dir = "image/";
            $target_file = $target_dir . basename($_FILES["resImg"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["resImg"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
            $uploadOk = 0;
            }

            if ($_FILES["resImg"]["size"] > 50000000){
                $uploadOk = 0;
            }

            if($imageFileType != "png") {
                    echo    "<script>
                            window.alert('Only PNG images!');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo    "<script>
                            window.alert('Upload Incomplete!');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                    // if everything is ok, try to upload file
                    } else {
                    $fileName = $target_dir . $id . ".png";

                    if (move_uploaded_file($_FILES["resImg"]["tmp_name"], $fileName)) {

                        $aconn -> query("INSERT INTO residents 
                        VALUES('$id', '$familyName', '$givenName', '$middleName', '$alias', '$faceMarks', '$birthDate', '$birthPlace', '$sex', '$civilStatus'
                                , '$nationality', '$faith', '$occupation', '$sector', '$spouseName', '$spouseOccu', '$voterState', '$cityAdd', '$provAdd', '$purok'
                                , '$homeNumbOne', '$homeNumbTwo', '$mobiNumbOne', '$mobiNumbTwo', '$email', '$resType', '$resState', '$dateTime', '$processedBy', '$transactionID', '$fileName')") 
                        or die(mysqli_error($aconn));

                        $string = "Created Resident " . $id . " " . $transactionID; 

                        $aconn -> query("INSERT INTO logs (timestamp, action, processedBy) VALUES('$dateTime','$string','$processedBy')") or die(mysqli_error($aconn));
                        echo    "<script>
                            window.alert('Edit Complete');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                    } else {
                        echo    "<script>
                            window.alert('Error!');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                    }
                    }

    }

    if(isset($_POST['editResident'])){
        $familyName = $_POST['familyName'];
        $givenName = $_POST['givenName'];
        $middleName = $_POST['middleName'];
        $alias = $_POST['alias'];
        $faceMarks = $_POST['faceMarks'];
        $birthDate = $_POST['birthDate'];
        $birthPlace = $_POST['birthPlace'];
        $sex = $_POST['sex'];
        $civilStatus = $_POST['civilStatus'];
        $nationality = $_POST['nationality'];
        $faith = $_POST['faith'];
        $occupation = $_POST['occupation'];
        $sector = $_POST['sector'];
        $spouseName = $_POST['spouseName'];
        $spouseOccu = $_POST['spouseOccu'];
        $voterState = $_POST['voterState'];
        $cityAdd = $_POST['cityAdd'];
        $provAdd = $_POST['provAdd'];
        $purok = $_POST['purok'];
        $homeNumbOne = $_POST['homeNumbOne'];
        $homeNumbTwo = $_POST['homeNumbTwo'];
        $mobiNumbOne = $_POST['mobiNumbOne'];
        $mobiNumbTwo = $_POST['mobiNumbTwo'];
        $email = $_POST['email'];
        $resType = $_POST['resType'];
        $resState = $_POST['resState'];

        if($spouseName == null || $spouseName == ""){
            $spouseName = "N/A";
        }

        if($spouseOccu == null || $spouseOccu == ""){
            $spouseOccu = "N/A";
        }

        $processedBy = $_COOKIE['admin'];

        $dateTime = new DateTime();
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        $dateTimeParts = explode(" ", $dateTime);

        $dateParts = explode("-", $dateTimeParts[0]);
        $year = $dateParts[0];
        $month = $dateParts[1];
        $day = $dateParts[2];

        $timeParts = explode(":", $dateTimeParts[1]);
        $hour = $timeParts[0];
        $minute = $timeParts[1];
        $second = $timeParts[2];

        $transactionID = $year . $month . $day . $hour . $minute . $second;

        $target_dir = "image/";
            $target_file = $target_dir . basename($_FILES["resImg"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["resImg"]["tmp_name"]);
            if($check !== false) {
                $uploadOk = 1;
            } else {
            $uploadOk = 0;
            }

            if ($_FILES["resImg"]["size"] > 50000000){
                $uploadOk = 0;
            }

            if($imageFileType != "png") {
                    echo    "<script>
                            window.alert('Only PNG images!');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                $uploadOk = 0;
                }

                if ($uploadOk == 0) {
                    echo    "<script>
                            window.alert('Upload Incomplete!');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                    // if everything is ok, try to upload file
                    } else {
                    $fileName = $target_dir . $id . ".png";

                    if (move_uploaded_file($_FILES["resImg"]["tmp_name"], $fileName)) {
                        echo    "<script>
                            window.alert('Edit Complete');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                    } else {
                        echo    "<script>
                            window.alert('Error!');
                            window.location.href = 'dashboard.people.php';
                            </script>";
                }
                }

        $userChecker = $dconn -> query("SELECT * FROM residents WHERE id = '$id'")or die($dconn -> error);
        $userValidator = $userChecker -> fetch_assoc();

        if($givenName != $userValidator['givenName']){
            $dconn -> query("UPDATE residents SET givenName = '$givenName' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($familyName != $userValidator['familyName']){
            $dconn -> query("UPDATE residents SET familyName = '$familyName' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($middleName != $userValidator['middleName']){
            $dconn -> query("UPDATE residents SET middleName = '$middleName' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($alias != $userValidator['alias']){
            $dconn -> query("UPDATE residents SET alias = '$alias' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($faceMarks != $userValidator['faceMarks']){
            $dconn -> query("UPDATE residents SET faceMarks = '$faceMarks' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($yearLvl != $userValidator['yearLevel']){
            $dconn -> query("UPDATE residents SET familyName = '$yearLvl' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($program != $userValidator['program']){
            $dconn -> query("UPDATE residents SET program = '$program' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($email != $userValidator['email']){
            $dconn -> query("UPDATE residents SET email = '$email' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($contact != $userValidator['contactNumber']){
            $dconn -> query("UPDATE residents SET contactNumber = '$contact' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($sex != $userValidator['sex']){
            $dconn -> query("UPDATE residents SET sex = '$sex' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($date != $userValidator['birthDate']){
            $dconn -> query("UPDATE residents SET birthDate = '$date' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        if($pass != $userValidator['pass']){
            $dconn -> query("UPDATE residents SET pass = '$pass' WHERE id = '$id'")or die($dconn -> error);
        }else{
        }

        echo "<script>
                alert('Values edited!');
                window.location.replace('datalog.php');
        </script>";

    }

    if(isset($_POST['deleteResident'])){
        $resID = $_POST['id'];

        $processedBy = $_COOKIE['admin'];

        $dateTime = new DateTime();
        $dateTime = $dateTime->format('Y-m-d H:i:s');
        $dateTimeParts = explode(" ", $dateTime);

        $dateParts = explode("-", $dateTimeParts[0]);
        $year = $dateParts[0];
        $month = $dateParts[1];
        $day = $dateParts[2];

        $timeParts = explode(":", $dateTimeParts[1]);
        $hour = $timeParts[0];
        $minute = $timeParts[1];
        $second = $timeParts[2];

        $transactionID = $year . $month . $day . $hour . $minute . $second;

        $aconn -> query("DELETE from residents WHERE id = '$resID'") or die($aconn -> error);

        $string = "Deleted Resident " . $resID . " " . $transactionID; 

        $aconn -> query("INSERT INTO logs (timestamp, action, processedBy) VALUES('$dateTime','$string','$processedBy')") or die(mysqli_error($aconn));

            echo "<script>
                alert('Resident deleted!');
                window.location.replace('dashboard.people.php');
            </script>";
    } 
?>
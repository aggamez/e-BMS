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
                            window.alert('Create Complete!');
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
        $id = $_POST['id'];
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

        $userChecker = $aconn -> query("SELECT * FROM residents WHERE id = '$id'")or die($aconn -> error);
        $userValidator = $userChecker -> fetch_assoc();

        if($givenName != $userValidator['givenName']){
            $aconn -> query("UPDATE residents SET givenName = '$givenName' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($familyName != $userValidator['familyName']){
            $aconn -> query("UPDATE residents SET familyName = '$familyName' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($middleName != $userValidator['middleName']){
            $aconn -> query("UPDATE residents SET middleName = '$middleName' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($alias != $userValidator['alias']){
            $aconn -> query("UPDATE residents SET alias = '$alias' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($faceMarks != $userValidator['faceMarks']){
            $aconn -> query("UPDATE residents SET faceMarks = '$faceMarks' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($birthDate != $userValidator['birthDate']){
            $aconn -> query("UPDATE residents SET birthDate = '$birthDate' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($birthPlace != $userValidator['birthPlace']){
            $aconn -> query("UPDATE residents SET birthPlace = '$birthPlace' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($email != $userValidator['email']){
            $aconn -> query("UPDATE residents SET email = '$email' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($homeNumbOne != $userValidator['homeNumbOne']){
            $aconn -> query("UPDATE residents SET homeNumbOne = '$homeNumbOne' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($homeNumbTwo != $userValidator['homeNumbTwo']){
            $aconn -> query("UPDATE residents SET homeNumbTwo = '$homeNumbTwo' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($mobiNumbOne != $userValidator['mobiNumbOne']){
            $aconn -> query("UPDATE residents SET mobiNumbOne = '$mobiNumbOne' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($mobiNumbTwo != $userValidator['mobiNumbTwo']){
            $aconn -> query("UPDATE residents SET mobiNumbTwo = '$mobiNumbTwo' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($occupation != $userValidator['occupation']){
            $aconn -> query("UPDATE residents SET occupation = '$occupation' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($sector != $userValidator['sector']){
            $aconn -> query("UPDATE residents SET sector = '$sector' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($civilStatus != $userValidator['civilStatus']){
            $aconn -> query("UPDATE residents SET civilStatus = '$civilStatus' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($nationality != $userValidator['nationality']){
            $aconn -> query("UPDATE residents SET nationality = '$nationality' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($faith != $userValidator['faith']){
            $aconn -> query("UPDATE residents SET faith = '$faith' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($spouseName != $userValidator['spouseName']){
            $aconn -> query("UPDATE residents SET spouseName = '$spouseName' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($spouseOccu != $userValidator['spouseOccu']){
            $aconn -> query("UPDATE residents SET spouseOccu = '$spouseOccu' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($voterState != $userValidator['voterState']){
            $aconn -> query("UPDATE residents SET voterState = '$voterState' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($cityAdd != $userValidator['cityAdd']){
            $aconn -> query("UPDATE residents SET cityAdd = '$cityAdd' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($provAdd != $userValidator['provAdd']){
            $aconn -> query("UPDATE residents SET provAdd = '$provAdd' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($purok != $userValidator['purok']){
            $aconn -> query("UPDATE residents SET purok = '$purok' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($resType != $userValidator['resType']){
            $aconn -> query("UPDATE residents SET resType = '$resType' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($resState != $userValidator['resState']){
            $aconn -> query("UPDATE residents SET resState = '$resState' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($mobiNumbTwo != $userValidator['mobiNumbTwo']){
            $aconn -> query("UPDATE residents SET mobiNumbTwo = '$mobiNumbTwo' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($sex != $userValidator['sex']){
            $aconn -> query("UPDATE residents SET sex = '$sex' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        $string = "Edited Resident " . $ID . " " . $transactionID; 

        $aconn -> query("INSERT INTO logs (timestamp, action, processedBy) VALUES('$dateTime','$string','$processedBy')") or die(mysqli_error($aconn));

            echo "<script>
                alert('Resident data edited!');
                window.location.replace('dashboard.people.php');
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

    if(isset($_POST['addAdmin'])){
        $resID = $_POST['resID'];

        $residents = $aconn -> query("SELECT * FROM residents where id='$resID'") or die($aconn -> error);
        $list = $residents -> fetch_assoc();

        $resFamName = $list["familyName"];
        $resGivenName = $list["givenName"];
        $resMiddleName = $list["middleName"];
        $accName = $list["alias"];

        $position = "";

        $accPass = "admin";

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

        $aconn -> query("INSERT INTO admin 
            VALUES('$accID', '$accName', '$resID', '$resFamName', '$resGivenName', '$resFamName', '$position', '$accPassHash', '$dateTime') ")
            or die($aconn -> error);

    

        echo    "<script>
                window.alert('Admin Account Created');
                window.location.href = 'logout.php';
                </script>";

    }  
    
    if(isset($_POST['editAdmin'])){
        $resID = $_POST['resID'];

        $residents = $aconn -> query("SELECT * FROM residents where id='$resID'") or die($aconn -> error);
        $list = $residents -> fetch_assoc();

        $resFamName = $list["familyName"];
        $resGivenName = $list["givenName"];
        $resMiddleName = $list["middleName"];
        $accName = $list["alias"];

        $position = "";

        $accPass = "admin";

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


        $userChecker = $aconn -> query("SELECT * FROM admin WHERE adminID = '$id'")or die($aconn -> error);
        $userValidator = $userChecker -> fetch_assoc();

        if($resFamName != $userValidator['resFamName']){
            $aconn -> query("UPDATE residents SET resFamName = '$resFamName' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($resGivenName != $userValidator['resGivenName']){
            $aconn -> query("UPDATE residents SET resGivenName = '$resGivenName' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($resType != $userValidator['resType']){
            $aconn -> query("UPDATE residents SET resType = '$resType' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($resState != $userValidator['resState']){
            $aconn -> query("UPDATE residents SET resState = '$resState' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($mobiNumbTwo != $userValidator['mobiNumbTwo']){
            $aconn -> query("UPDATE residents SET mobiNumbTwo = '$mobiNumbTwo' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

        if($sex != $userValidator['sex']){
            $aconn -> query("UPDATE residents SET sex = '$sex' WHERE id = '$id'")or die($aconn -> error);
        }else{
        }

    

        echo    "<script>
                window.alert('Admin Account Edited');
                window.location.href = 'logout.php';
                </script>";

    }  
?>
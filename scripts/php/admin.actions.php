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
?>
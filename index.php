<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        include 'scripts/php/admin.config.php';

        $adminCheck = $aconn -> query("SELECT * FROM data")or die($aconn -> error);

        if($adminChecker -> num_rows > 0){
            echo    "<script>
                        window.location.href = 'adminAccount.php';
                    </script>";
        } else{

            echo    "<script>
                        window.location.href = 'login.php';
                    </script>";

        }
            
    ?>
</body>
</html>
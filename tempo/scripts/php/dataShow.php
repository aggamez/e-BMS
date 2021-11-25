<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array test</title>
</head>
<body>
    <?php
        $mysqli = new mysqli('localhost', 'root', '', 'accounts') or die(mysqli_error($mysqli));
        $result = $mysqli -> query("SELECT * FROM data") or die($mysqli -> error);
        
        while($curr = $result -> fetch_assoc()){
            pre_show($curr);
        }

        function pre_show($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }

    ?>
    
</body>
</html>
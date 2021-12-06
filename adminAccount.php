<html>

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Base Admin</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/dashboard.css">
        <link rel="stylesheet" href="css/styles.css">

        <script src="scripts/js/bootstrap.bundle.min.js"></script>
    </head>

    <body>
        <div class="d-flex flex-row align-items-center justify-content-center w-100 h-100">
            <div class="d-flex flex-column" id="content-wrapper">
                <div class="container-fluid">
                    <h1>Create an admin account!</h1>
                </div>
                <form class="container-fluid d-flex align-items-center justify-content-center"
                    name="createAdminAcc"
                    action="#" 
                    method="post"
                    onsubmit="">
                    <button class="btn btn-lg bg-blue-500 true-gray-100 text-center" type="submit" name="createAdmin">Create account</button>
                </form>
            </div>
        </div>

        <?php 
        include 'scripts/php/admin.actions.php';
        date_default_timezone_set('Asia/Manila');

        if(isset($_POST['createAdmin'])){
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

            $accID = $nameSlice . $year . $month . $day . $hour . $min . $sec;

            echo    "<script>
                        div = document.createElement('div');

                        div.className = 'container-fluid d-flex flex-column mt-5 p-5 rounded-3 bg-warm-gray-400';

                        div.innerHTML = 
                        `
                            <h4> Account Name: '$accName'</h4>
                            <h4> Account Password: '$accPass'</h4> 

                            <h6> Account ID: '$accID'</h6>
                            <p> Made in: '$dateTime' </p>

                            <form 
                                name='createAdminAcc'
                                action='#' 
                                method='post'
                                class='d-flex align-items-center justify-content-center'>

                                <button class='btn btn-lg bg-green-500 true-gray-900 text-center' type='submit' name='acceptAdmin'> 
                                Finalize Account</button>
                            </form>
                        `;

                        document.getElementById('content-wrapper').appendChild(div);
                    </script>";
        }  
            
        ?>
    </body>

</html>
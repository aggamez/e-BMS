<?php
    include "../scripts/php/admin.config.php";
    include "../scripts/php/admin.controls.php";

    $id = 0;
    $tableRows = $dconn -> query("SELECT id, studNumber, firstName, lastName FROM data");
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Table</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../styles/bootstrap.min.css">
    <link rel="stylesheet" href="../styles/universals.css">
    <link rel="stylesheet" href="../styles/adminforms.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="../scripts/js/bootstrap.bundle.min.js"></script>
    <script src="../scripts/js/admin.actions.js"></script>
</head>

<body>
    
    <div class="bg-2 d-flex align-items-center justify-content-center">
        <div class="w-auto p-3 bg-red-200 rounded-3 d-flex align-items-center justify-content-center">
            <form 
                name="loginForm"
                action="datalog.php" 
                method="post"
                onsubmit=""
                class="d-grid gap-2"
            >
                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-12">
                        <h2 class="text-center poppins-700">
                            Admin Log-in
                        </h2>
                    </div>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text rounded-0 rounded-start border-2 bg-gray-300 bd-light-pink-500">
                                        <i class="bi bi-person-circle"></i>
                                    </span>                    
                                </div>
                                <input type="text" class="form-control border-2 bd-light-pink-500 inter-500" id="admin-user" name="admin-user" placeholder="Codename">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row container-fluid m-0">
                    <div class="col-md-12 d-flex justify-content-center align-content-center">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>                   
                                <input type="password" class="form-control border-2 bd-light-pink-500 password inter-500" id="admin-pass" name="admin-pass" placeholder="Password"/>
                                <div class="input-group-text rounded-0 rounded-end bg-gray-300 border-2 bd-light-pink-500">
                                    <input type="checkbox" class="checkButton" id="checkButton" onclick="return checkPassword()" />
                                    <label for="checkButton" class="bi bi-eye-slash-fill"></label>
                                    <label for="checkButton" class="bi bi-eye-fill"></label>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row container-fluid m-0">
                    <div class="col-md-12 d-flex flex-column justify-content-center align-content-center">
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-lg bg-blue-500 w-auto border border-2 bd-blue-700 oxygen-400" name="admin-log">Sign Up</button>
                        </div>
                    </div>
                </div>

            </form>
            
            
        
        </div>
    </div>
</body>

</html>
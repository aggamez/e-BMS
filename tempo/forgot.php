<?php
    include "scripts/php/config.php";
    include "scripts/php/user.controls.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/universals.css">
    <link rel="stylesheet" href="styles/validform.css">

    <script type="text/javascript" src="scripts/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <script src="scripts/js/actions.js"></script>
    <div class="origin d-flex align-items-center justify-content-center">
        <div class="w-auto p-3 bg-red-200 rounded-3 d-flex align-items-center justify-content-center">
            <form 
                name="passForm"
                action="#" 
                method="post"
                onsubmit="return validateCredentials()"
                class="d-grid gap-2"
            >
                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-12">
                        <h2 class="text-center poppins-700">
                            Forgot Password
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
                                <input type="text" class="form-control border-2 bd-light-pink-500 inter-500" id="studNumber" name="studNumber" placeholder="Student Number">
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
                                <input type="password" class="form-control border-2 bd-light-pink-500 password inter-500" id="pass" name="pass" placeholder="Enter new password" />
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
                    <div class="col-md-12 d-flex justify-content-center align-content-center">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-shield-lock-fill"></i>
                                </div>                   
                                <input type="password" class="form-control border-2 bd-light-pink-500 password inter-500" id="repass" name="repass" placeholder="Re-enter new password" />
                                <div class="input-group-text rounded-0 rounded-end bg-gray-300 border-2 bd-light-pink-500">
                                    <input type="checkbox" class="checkReButton" id="checkReButton" onclick="return checkPasswordRe()" />
                                    <label for="checkReButton" class="bi bi-eye-slash-fill"></label>
                                    <label for="checkReButton" class="bi bi-eye-fill"></label>
                                </div>   
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row container-fluid m-0">
                    <div class="col-md-12 d-flex flex-column justify-content-center align-content-center">
                        <div class="form-group text-center">
                            <button type="submit" name="forgot"
                            class="btn bg-blue-500 w-auto border border-2 bd-blue-700 oxygen-400">Reset Password</button>
                        </div>
                    </div>
                </div>

            </form>
            
            
        
        </div>
    </div>
</body>

</html>
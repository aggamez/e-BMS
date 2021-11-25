<?php
    include "scripts/php/config.php";
    include "scripts/php/user.controls.php";

    session_start();

    $id = $_SESSION['id'];

    $data = $dconn -> query("SELECT * from data WHERE id = '$id'") or die($dconn -> error);
    $user = $data -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log-In</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/validform.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript" src="scripts/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <script src="scripts/js/actions.js"></script>
    <div class="pointed d-flex align-items-center justify-content-center">

        <div class="w-75 p-3 bg-red-200 rounded-3 align-items-center justify-content-center d-grid gap-2">
            <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                <div class="col-12">
                    <h2 class="text-center poppins-700">
                        Welcome, <?php echo $user['firstName'] . " " . $user['lastName']; ?>!
                    </h2>
                </div>
            </div>


            <div class="row container-fluid d-grid gap-2">
                <div class="row container-fluid d-flex justify-content-center align-content-center gap-2 m-0">
                    <a href="#" class="col-4 btn gray-50 bg-gray-600 oxygen-500 view-acc" data-bs-toggle="modal" data-bs-target="#view-modal"
                    id="<?php echo $id ?>">
                        View Account
                    </a>

                    <a href="#" class="col-4 btn gray-50 bg-blue-500 oxygen-500 edit-acc" data-bs-toggle="modal" data-bs-target="#edit-modal"
                    id="<?php echo $id ?>">
                        Edit Account
                    </a>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center gap-2 m-0">
                    <a href="#" class="col-4 btn gray-50 bg-red-600 oxygen-500 del-acc" data-bs-toggle="modal" data-bs-target="#del-modal"
                    id="<?php echo $id?>">
                        Delete Account
                    </a>

                    <button class="col-4 btn gray-50 bg-gray-800 oxygen-500 log-out" 
                    type="submit" id="log-out" name="log-out">
                        Log Out
                    </button>
                </div>
            </div>

        </div>

        
    </div>

    <div class="modal fade" id="view-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-xl modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title poppins-500 text-center" id="exampleModalLabel">View User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" name="close"></button>
                </div>

                <div class="modal-body bg-red-200 d-flex align-items-center justify-content-center">
                
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn bg-gray-250 oxygen-400" data-bs-dismiss="modal" name="close">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="edit-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-xl modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title poppins-500 text-center" id="exampleModalLabel">Edit User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" name="close"></button>
                </div>

                <div class="modal-body bg-red-200 d-flex align-items-center justify-content-center">
                
                </div>

                <div class="modal-footer">
                    <a href="#" class="btn bg-gray-250 oxygen-400" data-bs-dismiss="modal" name="close">Close</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="del-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title poppins-500 text-center" id="exampleModalLabel">Delete Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" name="close"></button>
                </div>

                <div class="modal-body bg-red-200 d-flex align-items-center justify-content-center">
                    <h4 class="gray-800 inter-500 text-center">Are you sure to delete this account?</h4>
                </div>

                <div class="modal-footer">

                </div>
                
            </div>
        </div>
    </div>

    <div class="modal fade" id="out-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body bg-red-200 d-flex align-items-center justify-content-center">
                    <h4 class="gray-800 inter-500 text-center">Log out this account?</h4>
                </div>

                <div class="modal-footer">

                </div>
                
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.view-acc').click(function() {
                var id = <?php echo $id?>;
                $.ajax({
                    url:  'scripts/php/userView.ajax.php',
                    type: 'post',
                    data: {id: id},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#view-modal').modal('show');
                    }
                });
            });

            $('.del-acc').click(function() {
                var id = <?php echo $id?>;
                $.ajax({
                    url:  'scripts/php/userDelete.ajax.php',
                    type: 'post',
                    data: {id: id},
                    success: function(response){
                        $('.modal-footer').html(response);
                        $('#del-modal').modal('show');
                    }
                });
            });

            $('.edit-acc').click(function() {
                var id = <?php echo $id?>;
                $.ajax({
                    url:  'scripts/php/userEdit.ajax.php',
                    type: 'post',
                    data: {id: id},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#edit-modal').modal('show');
                    }
                });
            });

            $('.log-out').click(function() {
                var id =  <?php echo $id?>;
                $.ajax({
                    url:  'scripts/php/userOut.ajax.php',
                    type: 'post',
                    data: {id: id},
                    success: function(response){
                        $('.modal-footer').html(response);
                        $('#out-modal').modal('show');
                    }
                });
            });
        });

    </script>

</body>

</html>
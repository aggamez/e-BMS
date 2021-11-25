<?php
    include "../scripts/php/config.php";
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
</head>

<body>
    <script src="../scripts/js/admin.actions.js"></script>  
    <div class="bg-1 d-flex align-items-center justify-content-center">
        <div class="w-auto h-75 p-4 bg-gray-250 rounded-3 d-grid align-items-center justify-content-center">  
            
            <div class="row justify-content-center">
                <div class="col-md-12 text-center">
                    <h3 class="oxygen-700">User Data</h3>
                </div>
            </div> 

            <div class="row justify-content-center scroll-avail bg-light-pink-400 rounded rounded-3">
                <table class="col-md-12 table table-striped table-responsive-sm table-responsive">
                    <thead class="text-center border border-0 bg-light-pink-700">
                        <tr class="text-center border border-0">
                            <th class="inter-500 gray-100">ID</th>
                            <th class="inter-500 gray-100">Student Number</th>
                            <th class="inter-500 gray-100">First Name</th>
                            <th class="inter-500 gray-100">Last Name</th>
                            <th class="inter-500 gray-100">Actions</th> 
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                            while ($rows = $tableRows -> fetch_assoc()): ?>
                                <tr>
                                    <td class="inter-500 gray-700"><?php echo $rows['id']; ?></td>
                                    <td class="inter-500 gray-700"><?php echo $rows['studNumber']; ?></td>
                                    <td class="inter-500 gray-700"><?php echo $rows['firstName']; ?></td>
                                    <td class="inter-500 gray-700"><?php echo $rows['lastName']; ?></td>
                                    <td class="mx-auto">
                                        <a href="#" class="mx-1 clear viewModal" data-id="<?php echo $rows['id']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#view-form" id="<?php echo $rows['id']; ?>">
                                            <i class="bi bi-eye-fill blue-600"></i>
                                        </button>
                                        <a href="#" class="mx-1 clear editModal" data-id="<?php echo $rows['id']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#edit-form" id="<?php echo $rows['id']; ?>">
                                            <i class="bi bi-pencil-square gray-800"></i>
                                        </a>
                                        <a href="#" class="mx-1 clear delModal" data-id="<?php echo $rows['id']; ?>"
                                            data-bs-toggle="modal" data-bs-target="#del-form" id="<?php echo $rows['id']; ?>">
                                        <i class="bi bi-trash-fill red-550"></i>
                                    </a>

                                    </td>
                                </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="view-form" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

    <div class="modal fade" id="edit-form" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-xl modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title poppins-500 text-center" id="exampleModalLabel">Edit User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" name="close"></button>
                </div>

                <div class="modal-body bg-red-200 d-flex align-items-center justify-content-center">
                
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="del-form" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-xl modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title poppins-500 text-center" id="exampleModalLabel">Delete User Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" name="close"></button>
                </div>

                <div class="modal-body bg-red-200 d-flex align-items-center justify-content-center">
                    <h4 class="gray-800 inter-500">Are you sure to delete this account?</h4>
                </div>

                <div class="modal-footer">

                </div>
                
            </div>
        </div>
    </div>
    
    <script type="text/javascript">
        $(document).ready(function() {
            $('.viewModal').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: '../scripts/php/view.ajax.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#view-form').modal('show');
                    }
                });
            });

            $('.editModal').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: '../scripts/php/edit.ajax.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#edit-form').modal('show');
                    }
                });
            });

            $('.delModal').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: '../scripts/php/delete.ajax.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-footer').html(response);
                        $('#del-form').modal('show');
                    }
                });
            });
        });

    </script>

    

</body>
</html>
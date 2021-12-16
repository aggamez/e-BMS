<?php
$xml=simplexml_load_file("configure.xml") or die("Error: Cannot create object");

$brgyName = $xml-> name;
$brgyAddr = $xml-> address;
$brgyProf = $xml-> profile;
$brgySpsh = $xml-> splash;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/dashboard.css">


    <script src="scripts/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
<nav class="navbar navbar-dark bg-dark" tabindex="2">
      <div class="container-fluid">
        <div class="navbar-brand">
        <a class=" btn btn-sm bg-cool-gray-600 true-gray-50" data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar">
          <span class="bi-list"></span>
        </a>
        <a class="brand-text nav-link active d-inline-flex align-middle disable">Barangay <?php echo $brgyName ?></a>

      </div>
        
      </div>
    </nav>

    <div class="offcanvas offcanvas-start sidebar bg-cool-gray-900" tabindex="-1" id="sidebar">
      <div class="offcanvas-body text-sm-start">
      <nav class="navbar-dark">
        <div class="container d-flex flex-column align-items-center justify-content-center true-gray-100">
            <img src="<?php echo $brgyProf;?>" alt="profile image" class="logo">
            <h5>Barangay <?php echo $brgyName?></h5>
            <p class="text-break text-center w-75"><?php echo $brgyAddr?></p>
        </div>
          <ul class="navbar-nav">
            <li>
              <div class="warm-gray-50 small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="dashboard.main.php" class="nav-link px-3 ">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
            </li>
            <li class="my-2"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="warm-gray-50 small fw-bold text-uppercase px-3">
                  PROCESSES
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#residents"
              >
                <span class="me-2"><i class="bi bi-person-circle"></i></span>
                <span>Resident Information</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="residents">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="dashboard.people.php" class="nav-link px-3 active">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Residents</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3"
                data-bs-toggle="collapse"
                href="#issue"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Issue Certificate</span>
                <span class="ms-auto">
                </span>
              </a>
            </li>
            <li class="my-2"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="warm-gray-50 small fw-bold text-uppercase px-3">
                Admin
              </div>
            </li>
            <li>
              <a href="dashboard.admins.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Accounts</span>
              </a>
            </li>
            <li>
              <a href="dashboard.adconfig.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Logs</span>
              </a>
            </li>
            <li>
              <a href="dashboard.adconfig.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Config</span>
              </a>
            </li>
            <li>
              <a href="logout.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Log-out</span>
              </a>
            </li>
          </ul>
      </div>
    </div>
    <!-- sidebar -->

    
    <!-- main content -->
    <main>
      <div class="container main" id="main">
          <div class="d-grid gap-3 py-4">
              <div class="row">

                <div class="container-fluid col-lg-5">
                  <div class="container d-flex flex-row mb-2 align-items-center">
                    <h3 class="flex-grow-1">Puroks</h3>
                    <a class="btn btn-sm bg-green-400 align-items-center d-flex flex-row justify-content-center" href=""
                      data-bs-toggle="modal" data-bs-target="#apmodal">
                      <span class="bi bi-plus-circle"></span>
                      <span class=" ms-2">Add Purok</span>
                    </a>
                  </div>
                  <hr>
                  <?php
                    include 'scripts/php/admin.actions.php';

                    $purok = $aconn -> query("SELECT * from purok") or die(mysqli_error($aconn));
                    if($purok -> num_rows > 0): ?>
                          <div class="row justify-content-center scroll-avail bg-light-pink-400 rounded rounded-3 table-height overflow-auto">
                            <table class="col-md-12 table table-striped table-responsive-sm table-responsive">
                                <thead class="text-center border border-0 bg-light-pink-700">
                                    <tr class="text-center border border-0">
                                        <th class="inter-500 gray-100">ID</th>
                                        <th class="inter-500 gray-100">Purok Name</th>
                                        <th class="inter-500 gray-100">Actions</th> 
                                    </tr>
                                </thead>
              
                                <tbody class="table-body" id="table-body">
                                      <?php while ($data = $purok -> fetch_assoc()): ?>
                                        <tr class="row-height">
                                          <td class="inter-500 gray-700"><?php echo $data['id']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['name']; ?></td>
                                          <td class="mx-auto text-center">
                                            <a href="#" class="mx-1 clear edit" data-id="<?php echo $data['id']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#edit-Purok" id="<?php echo $data['id']; ?>">
                                                <i class="bi bi-pencil-square true-gray-500"></i>
                                            </a>
                                            <a href="#" class="mx-1 clear delete" data-id="<?php echo $data['id']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#del-Purok" id="<?php echo $data['id']; ?>">
                                            <i class="bi bi-trash-fill red-500"></i>
                                            </a>
                                          </td>
                                        </tr>

                                      <?php endwhile?>
                                      
                                </tbody>
                              </table>
                          </div>
                      
                    <?php else: ?>
                        <div class ="container bg-red-300 text-center p-5">
                            No added puroks!
                        </div> 
                      
                        
                    <?php endif; ?>
                </div>

                <div class="container-fluid col-lg-5">
                  <div class="container d-flex flex-row mb-2 align-items-center">
                    <h3 class="flex-grow-1">Officials</h3>
                    <a class="btn btn-sm bg-green-400 align-items-center d-flex flex-row justify-content-center" href=""
                      data-bs-toggle="modal" data-bs-target="#posaddmodal">
                      <span class="bi bi-plus-circle"></span>
                      <span class=" ms-2">Add Position</span>
                    </a>
                  </div>
                  <hr>
                  <?php
                    include 'scripts/php/admin.actions.php';

                    $positions = $aconn -> query("SELECT * from positions") or die(mysqli_error($aconn));
                    if($positions -> num_rows > 0): ?>
                          <div class="row justify-content-center scroll-avail bg-light-pink-400 rounded rounded-3 table-height overflow-auto">
                            <table class="col-md-12 table table-striped table-responsive-sm table-responsive">
                                <thead class="text-center border border-0 bg-light-pink-700">
                                    <tr class="text-center border border-0">
                                        <th class="inter-500 gray-100">Position</th>
                                        <th class="inter-500 gray-100">Actions</th> 
                                    </tr>
                                </thead>
              
                                <tbody class="table-body" id="table-body">
                                      <?php while ($pos = $positions -> fetch_assoc()): ?>
                                        <tr class="row-height">
                                          <td class="inter-500 gray-700"><?php echo $pos['name']; ?></td>
                                          <td class="mx-auto text-center">
                                            <a href="#" class="mx-1 clear delete" data-id="<?php echo $pos['id']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#del-Purok" id="<?php echo $pos['id']; ?>">
                                            <i class="bi bi-trash-fill red-500"></i>
                                            </a>
                                          </td>
                                        </tr>

                                      <?php endwhile?>
                                      
                                </tbody>
                              </table>
                          </div>
                      
                    <?php else: ?>
                        <div class ="container bg-red-300 text-center p-5">
                            No added positions
                        </div> 
                      
                        
                    <?php endif; ?>
                </div>  

              </div>

              <div class="row gap-2">
                <div class="container-fluid col-lg-12">
                  <div class="container d-flex flex-column mb-2 align-items-center">
                      <h3 class="">Configure System</h3>
                      <div class="container button-group d-flex flex-row justify-content-center align-items-center gap-2">
                        <a class="btn btn-sm bg-green-400 align-items-center d-flex flex-row justify-content-center" href=""
                        data-bs-toggle="modal" data-bs-target="#editconfig">
                          <span class="bi bi-plus-circle"></span>
                          <span class=" ms-2">Edit Details</span>
                        </a>

                        <a class="btn btn-sm bg-green-400 align-items-center d-flex flex-row justify-content-center" href=""
                          data-bs-toggle="modal" data-bs-target="#editprofile">
                          <span class="bi bi-plus-circle"></span>
                          <span class=" ms-2">Upload Logo</span>
                        </a>

                        <a class="btn btn-sm bg-green-400 align-items-center d-flex flex-row justify-content-center" href=""
                          data-bs-toggle="modal" data-bs-target="#editsplash">
                          <span class="bi bi-plus-circle"></span>
                          <span class=" ms-2">Upload Splash</span>
                        </a>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </main>

    <div class="modal fade" id="apmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Purok</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form
                name="addPurok"
                action="#" 
                method="post"
                onsubmit=""
                class="d-flex flex-column"
                >
                <div class="input-group">
                    <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                        <i class="bi bi-card-text"></i>                   
                    </div>
                    <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                    id="purokName" name="purokName" placeholder="Purok Name">
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="addPurok"
                        class="btn bg-green-200 border w-auto text-center">Add Purok</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="edit-Purok" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Purok</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="del-Purok" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Delete Purok</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>



    <div class="modal fade" id="posaddmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Official</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form
                name="addPosition"
                action="#" 
                method="post"
                onsubmit=""
                class="d-flex flex-column"
                >
                <div class="input-group">
                    <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                        <i class="bi bi-card-text"></i>                   
                    </div>
                    <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                    id="posName" name="posName" placeholder="Position Name">
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="addPosition"
                        class="btn bg-green-200 border w-auto text-center">Add Position</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

   

    <div class="modal fade" id="del-pos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Delete Position</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editconfig" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Barangay Config</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form
                name="confBrgy"
                action="#" 
                method="post"
                onsubmit=""
                class="d-flex flex-column"
                >
                <div class="d-flex flex-column gap-3">
                  <div class="input-group">
                      <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                          <i class="bi bi-card-text"></i>                   
                      </div>
                      <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                      id="brgyName" name="brgyName" placeholder="Barangay Name" value="<?php echo $brgyName; ?>">
                  </div>

                  <div class="input-group">
                      <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                          <i class="bi bi-card-text"></i>                   
                      </div>
                      <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                      id="brgyAddr" name="brgyAddr" placeholder="Barangay Address" value="<?php echo $brgyAddr; ?>">
                  </div>
                </div>
                
                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="confBarangay"
                        class="btn bg-green-200 border w-auto text-center">Configure Barangay</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="modal fade" id="editprofile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Barangay Logo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form
                name="confProf"
                action="" 
                method="post"
                onsubmit=""
                enctype="multipart/form-data"
                class="d-flex flex-column"
                >
                <div class="d-flex flex-column gap-3">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Insert Logo</label>
                    <input class="form-control" type="file" id="logoFile" name="logoFile">
                  </div>
                </div>
                
                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="confProfile"
                        class="btn bg-green-200 border w-auto text-center">Edit Logo</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="editsplash" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Barangay Splash</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form
                name="confSpsh"
                action="" 
                method="post"
                onsubmit=""
                enctype="multipart/form-data"
                class="d-flex flex-column"
                >
                <div class="d-flex flex-column gap-3">
                  <div class="mb-3">
                    <label for="formFile" class="form-label">Insert Splash</label>
                    <input class="form-control" type="file" id="spshFile" name="spshFile">
                  </div>
                </div>
                
                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="confSplash"
                        class="btn bg-green-200 border w-auto text-center">Update Splash</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- main content -->

    <script type="text/javascript">
        $(document).ready(function() {
            $('.edit').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/purok.edit.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#editPurok').modal('show');
                    }
                });
            });

            $('.delete').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/purok.delete.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#delPurok').modal('show');
                    }
                });
            });
        });
    </script>
</body>
</html>
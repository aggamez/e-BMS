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
    <!-- main content -->
    <main>
      <div class="container main" id="main">
          <div class="d-grid gap-3 py-4">
              <div class="row">

                <div class="container-fluid col-lg-12">
                  <div class="container d-flex flex-column mb-2 align-items-center">
                    <h3 class="">Admins</h3>
                    <div class="container d-flex flex-row gap-5 bg-warm-gray-800 py-3 px-2">
                      <form class="d-flex flex-row flex-grow-1">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn bg-green-400" type="submit"><i class="bi bi-search"></i></button>
                      </form>

                      <a class="btn btn-sm bg-green-400 align-items-center d-flex flex-row justify-content-center" href=""
                        data-bs-toggle="modal" data-bs-target="#admin">
                        <span class="bi bi-plus-circle"></span>
                        <span class=" ms-2">Add Admin</span>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <?php
                    include 'scripts/php/admin.actions.php';

                    $admin = $aconn -> query("SELECT * from admin") or die(mysqli_error($aconn));
                    if($admin -> num_rows > 0): ?>
                          <div class="row justify-content-center scroll-avail bg-light-pink-400 rounded rounded-3 table-height overflow-auto">
                            <table class="col-md-12 table table-striped table-responsive-sm table-responsive">
                                <thead class="text-center border border-0 bg-light-pink-700">
                                    <tr class="text-center border border-0">
                                        <th class="inter-500 gray-100">Actions</th> 
                                        <th class="inter-500 gray-100">ID</th>
                                        <th class="inter-500 gray-100">Last Name</th>
                                        <th class="inter-500 gray-100">Given Name</th>
                                        <th class="inter-500 gray-100">Middle Name</th>
                                        <th class="inter-500 gray-100">Username</th>
                                        
                                    </tr>
                                </thead>
              
                                <tbody class="table-body" id="table-body">
                                      <?php while ($data = $admin -> fetch_assoc()): ?>
                                        <tr class="row-height">
                                        <td class="mx-auto text-center">
                                            <a href="#" class="mx-1 clear view" data-id="<?php echo $data['adminID']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#view-admin" id="<?php echo $data['adminID']; ?>">
                                                <i class="bi bi-eye-fill true-gray-500"></i>
                                            </a>
                                            <a href="#" class="mx-1 clear edit" data-id="<?php echo $data['adminID']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#edit-admin" id="<?php echo $data['adminID']; ?>">
                                                <i class="bi bi-pencil-square true-gray-500"></i>
                                            </a>
                                            <a href="#" class="mx-1 clear delete" data-id="<?php echo $data['adminID']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#del-admin" id="<?php echo $data['adminID']; ?>">
                                            <i class="bi bi-trash-fill red-500"></i>
                                            </a>
                                          </td>
                                          <td class="inter-500 gray-700"><?php echo $data['resID']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['resFamName']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['resGivenName']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['resMiddleName']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['adminName']; ?></td>
                                          
                                        </tr>

                                      <?php endwhile?>
                                      
                                </tbody>
                              </table>
                          </div>
                      
                    <?php else: ?>
                        <div class ="container bg-red-300 text-center p-5">
                            No added admins!
                        </div> 
                      
                        
                    <?php endif; ?>
                </div>
          </div>
      </div>
    </main>

    <div class="modal fade" id="admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form
                name="addAdmin"
                action="#" 
                method="post"
                onsubmit=""
                class="d-flex flex-column align-items-center justify-content-center"
                >
                    <div class="container d-flex flex-column gap-1 align-items-center justify-content-center">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          


                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="resID" name="resID">
                             <?php
                                $residents = $aconn -> query("SELECT * FROM residents") or die($aconn -> error);
                                while ($list = $residents -> fetch_assoc()): ?>
                             ?>
                                <option value="<?php echo $list['id'];?>"><?php echo $list['alias'];?></option>

                            <?php endwhile?>
                            </select>
                      </div>
                    </div>
                <hr>

                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="addAdmin" id="addAdmin"
                        class="btn bg-green-200 border w-auto text-center">Add Admin</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="view-admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">View Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="edit-admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="del-admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Delete Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

  <script type="text/javascript">
  $(document).ready(function() {
            $('.view').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/admin.view.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#view-admin').modal('show');
                    }
                });
            });

            $('.edit').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/admin.edit.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#edit-admin').modal('show');
                    }
                });
            });

            $('.delete').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/admin.delete.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#del-admin').modal('show');
                    }
                });
            });
        });
  </script>
</body>
</html>
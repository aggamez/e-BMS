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
  <script src="scripts/js/dashboard.controls.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
  <script src="scripts/js/dashboard.controls.js"></script>
  <!-- navbar -->
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
        <div class="container-fluid mt-3">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-xl-8 col-md-6 mb-3">
                <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">OffCommitee</th>
                    <th scope="col">BrgyPosition</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>
                    <tr>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
                </table>
            </div>
            <div class="col-xl-4 col-md-6 mb-3">
                <div class="row">
                    <!-- Total Registerd Population Card Example -->
                    <div class="col-xl-12 col-md-6 mb-2">
                        <div class="card border-left-primary bg-true-gray-100 shadow h-100 py-2 text-center">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold blue-400 text-uppercase mb-1">
                                            Total Registered Population</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">22</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Male Card Example -->
                    <div class="col-xl-6 col-md-6 mb-2">
                        <div class="card border-left-success bg-true-gray-100 shadow h-100 py-2 text-center">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-success text-uppercase mb-1">
                                            Male</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">11</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Female Card Example -->
                    <div class="col-xl-6 col-md-6 mb-2">
                        <div class="card border-left-success bg-true-gray-100 shadow h-100 py-2 text-center">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-success text-uppercase mb-1">
                                            Female</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">11</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- Registered Voters Card Example -->
                    <div class="col-xl-12 col-md-6 mb-4">
                        <div class="card border-left-warning bg-true-gray-100 shadow h-100 py-2 text-center">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="font-weight-bold text-warning text-uppercase mb-1">
                                            Registered Voters</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">16</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 col-md-6 mb-4">
                        <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">OffCommitee</th>
                    <th scope="col">BrgyPosition</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                    </tr>`
                    <tr>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    </tr>
                    <tr>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                    </tr>
                </tbody>
                </table>
                    </div>
                </div>
            </div>
        </div>
        </div>  
    </div>
  </main>
  <!-- main content -->

  
</body>

</html>
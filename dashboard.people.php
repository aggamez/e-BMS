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
              <a href="dashboard.status.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-bar-chart-fill"></i></span>
                <span>Barangay Status</span>
              </a>
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
                  <li>
                    <a href="dashboard.violations.php" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Violation Records</span>
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
                    <h3 class="">Residents</h3>
                    <div class="container d-flex flex-row gap-5 bg-warm-gray-800 py-3 px-2">
                      <form class="d-flex flex-row flex-grow-1">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success " type="submit"><i class="bi bi-search"></i></button>
                      </form>

                      <a class="btn btn-sm bg-green-400 align-items-center d-flex flex-row justify-content-center" href=""
                        data-bs-toggle="modal" data-bs-target="#addResident">
                        <span class="bi bi-plus-circle"></span>
                        <span class=" ms-2">Add Resident</span>
                      </a>
                    </div>
                  </div>
                  <hr>
                  <?php
                    include 'scripts/php/admin.actions.php';

                    $resi = $aconn -> query("SELECT * from residents ORDER BY registerDate DESC") or die(mysqli_error($aconn));
                    if($resi -> num_rows > 0): ?>
                          <div class="row justify-content-center scroll-avail bg-light-pink-400 rounded rounded-3 table-height overflow-auto">
                            <table class="col-md-12 table table-striped table-responsive-sm table-responsive">
                                <thead class="text-center border border-0 bg-light-pink-700">
                                    <tr class="text-center border border-0">
                                        <th class="inter-500 gray-100">Actions</th> 
                                        <th class="inter-500 gray-100">ID</th>
                                        <th class="inter-500 gray-100">Last Name</th>
                                        <th class="inter-500 gray-100">Given Name</th>
                                        <th class="inter-500 gray-100">Middle Name</th>
                                        <th class="inter-500 gray-100">Alias</th>
                                        
                                    </tr>
                                </thead>
              
                                <tbody class="table-body" id="table-body">
                                      <?php while ($data = $resi -> fetch_assoc()): ?>
                                        <tr class="row-height">
                                        <td class="mx-auto text-center">
                                            <a href="#" class="mx-1 clear view" data-id="<?php echo $data['id']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#view-Resi" id="<?php echo $data['id']; ?>">
                                                <i class="bi bi-eye-fill true-gray-500"></i>
                                            </a>
                                            <a href="#" class="mx-1 clear edit" data-id="<?php echo $data['id']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#edit-Resi" id="<?php echo $data['id']; ?>">
                                                <i class="bi bi-pencil-square true-gray-500"></i>
                                            </a>
                                            <a href="#" class="mx-1 clear delete" data-id="<?php echo $data['id']; ?>"
                                                data-bs-toggle="modal" data-bs-target="#del-Resi" id="<?php echo $data['id']; ?>">
                                            <i class="bi bi-trash-fill red-500"></i>
                                            </a>
                                          </td>
                                          <td class="inter-500 gray-700"><?php echo $data['id']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['familyName']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['givenName']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['middleName']; ?></td>
                                          <td class="inter-500 gray-700"><?php echo $data['alias']; ?></td>
                                          
                                        </tr>

                                      <?php endwhile?>
                                      
                                </tbody>
                              </table>
                          </div>
                      
                    <?php else: ?>
                        <div class ="container bg-red-300 text-center p-5">
                            No added residents!
                        </div> 
                      
                        
                    <?php endif; ?>
                </div>
          </div>
      </div>
    </main>

    <div class="modal fade" id="addResident" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Add Resident</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form
                name="addResident"
                action="#" 
                method="post"
                onsubmit=""
                class="d-grid gap-4"
                enctype="multipart/form-data"
                >
                <div class="row">
                  <h6>Essential Details</h6>
                  <div class="col-lg-4">
                    <div class="container">
                      <div class="d-flex flex-column justify-content-center align-items-center">
                        <div id="preview" class="logo border border-1 bd-true-gray-900"></div>
                        <input class="form-control w-auto" type="file" id="resImg" name="resImg">
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="familyName" name="familyName" placeholder="Family Name">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="givenName" name="givenName" placeholder="Given Name">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="middleName" name="middleName" placeholder="Middle Name">
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="alias" name="alias" placeholder="Alias">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="birthDate" 
                                name="birthDate" onfocus="(this.type='date')" placeholder="Birth Date" >
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="birthPlace" name="birthPlace" placeholder="Birth Place">
                      </div>
                    </div>
                  </div>
                </div>

                <hr>

                <div class="row">
                <h6>Personal Details</h6>
                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="sex" name="sex" >
                                <option value="0" selected>Sex</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="faceMarks" name="faceMarks" placeholder="Face Marks">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="faith" name="faith" placeholder="Religion / Belief">
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="nationality" name="nationality" placeholder="Nationality">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="occupation" name="occupation" placeholder="Occupation">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="sector" name="sector" >
                                <option value="000" selected>Sector</option>
                                <option value="PRI">Private</option>
                                <option value="PUB">Public</option>
                                <option value="GOV">Government</option>
                                <option value="UNM">Unemployed</option>
                                <option value="OSY">Out of School Youth</option>
                                <option value="OSC">Out of School Childre</option>
                                <option value="PWD">Person with Disability</option>
                                <option value="SEC">Senior Citizen</option>
                                <option value="OFW">Overseas Filipino Worker</option>
                                <option value="SLP">Solo Parent</option>
                                <option value="INP">Indigenous People</option>
                                <option value="OTH">Others</option>
                            </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="civilStatus" name="civilStatus">
                                <option value="0" selected>Civil Status</option>
                                <option value="S">Single</option>
                                <option value="M">Married</option>
                                <option value="X">Separated</option>
                                <option value="W">Widowed</option>
                            </select>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="spouseName" 
                                name="spouseName" placeholder="Spouse Name" >
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="spouseOccu" name="spouseOccu" placeholder="Spouse Occupation">
                      </div>
                    </div>
                  </div>
                </div>

                <hr>
                
                <div class="row">
                <h6>Contact Information</h6>
                  <div class="col-lg-6">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="cityAdd" name="cityAdd" placeholder="City Address">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="provAdd" name="provAdd" placeholder="Provincial Address">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="purok" name="purok" >
                                <option value="0" selected>Purok</option>
                                <?php 
                                include 'scripts/php/admin.actions.php';

                                $purok = $aconn -> query("SELECT * from purok") or die(mysqli_error($aconn));
                                while ($data = $purok -> fetch_assoc()): ?>
                                <option value="<?php echo $data['id'];?>"><?php echo $data['name'];?></option>
                                <?php endwhile;?>
                            </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="homeNumbOne" name="homeNumbOne" placeholder="Home Number One">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="homeNumbTwo" name="homeNumbTwo" placeholder="Home Number Two">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="email" name="email" placeholder="e-Mail">
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-3">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="mobiNumbOne" name="mobiNumbOne" placeholder="Mobile Number One">
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="mobiNumbTwo" name="mobiNumbTwo" placeholder="Mobile Number Two">
                      </div>
                    </div>
                  </div>
                </div>    

                <hr>
                
                <div class="row">
                <h6>Resident Information</h6>
                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="resType" name="resType" >
                                <option value="0" selected>Resident Type</option>
                                <option value="N">Native</option>
                                <option value="R">Rentee</option>
                            </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                    <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="resState" name="resState" >
                                <option value="0" selected>Resident State</option>
                                <option value="A">Active</option>
                                <option value="I">Inactive</option>
                                <option value="D">Deceased</option>
                            </select>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-4">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                            <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                <i class="bi bi-card-text"></i>                   
                            </div>
                            <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                              data-live-search="true" id="voterState" name="voterState" >
                                  <option value="0" selected>Voter Status</option>
                                  <option value="N" id="VN">Not Eligible</option>
                                  <option value="A" id="VA">Active</option>
                                  <option value="I" id="VI">Inactive</option>
                            </select>
                      </div>
                    </div>
                  </div>
                </div>  

                

                <hr>
               

                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="addResident" id="addResident"
                        class="btn bg-green-200 border w-auto text-center">Add Resident</button>
                </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="view-Resi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">View Resident</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="edit-Resi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Edit Resident</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="del-Resi" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Delete Resident</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            
          </div>
        </div>
      </div>
    </div>

  <script type="text/javascript">
    $(document).ready(function(){
        function checkMarried(){
          var check = document.getElementById('civilStatus');
          if (check.value == "M"){
            document.getElementById("spouseName").removeAttribute('readonly');
            document.getElementById("spouseOccu").removeAttribute('readonly');
            document.getElementById("spouseName").value = " ";
            document.getElementById("spouseOccu").value = " ";
        } else{
            document.getElementById("spouseName").setAttribute('readonly', 'readonly');
            document.getElementById("spouseOccu").setAttribute('readonly', 'readonly');
            document.getElementById("spouseName").value = "N/A ";
            document.getElementById("spouseOccu").value = "N/A ";
            
        }
    }

    $("#civilStatus").on("change", checkMarried);
    
});

  $(document).ready(function(){
    function checkVoters(){
          var date = document.getElementById('birthDate');
          var checkDate = new Date();
          var checkYear = checkDate.getFullYear();
          var checkMonth = checkDate.getMonth();
          var checkDay = checkDate.getDate();
          checkYear = checkYear - 18;
          checkMonth = checkMonth + 1;
          checkDate = checkYear + "-" + checkMonth + "-" + checkDay;

          if(date.value > checkDate){
            document.getElementById('voterStatus').value = "N";
            document.getElementById('VA').disabled = "true";
            document.getElementById('VI').disabled = "true";
          }
        }

        $("#birthDate").on("change", checkVoters); 
  });

  $(document).ready(function(){
    function imagePreview(fileInput) {
    if (fileInput.files && fileInput.files[0]) {
        var fileReader = new FileReader();
        fileReader.onload = function (event) {
            $('#preview').html('<img src="'+event.target.result+'" class="image" width="200" height="200"/>');
        };
        fileReader.readAsDataURL(fileInput.files[0]);
      }
    }

    $("#resImg").change(function () {
      imagePreview(this);
    });
  });

  $(document).ready(function() {
            $('.view').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/resident.view.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#view-Resi').modal('show');
                    }
                });
            });

            $('.edit').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/resident.edit.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#edit-Resi').modal('show');
                    }
                });
            });

            $('.delete').click(function() {
                var uid = $(this).data('id');
                $.ajax({
                    url: 'scripts/php/resident.delete.php',
                    type: 'post',
                    data: {uid: uid},
                    success: function(response){
                        $('.modal-body').html(response);
                        $('#del-Resi').modal('show');
                    }
                });
            });
        });
  </script>
</body>
</html>
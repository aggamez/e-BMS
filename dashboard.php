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
</head>
<body>
    <!-- navbar -->
      <nav class="navbar navbar-dark fixed-top bg-cool-gray-900">
        <div class="d-flex px-2 flex-nowrap">
          <a class="btn btn-sm bg-cool-gray-600 true-gray-50" data-bs-toggle="offcanvas" href="#sidebar" role="button" aria-controls="sidebar">
            <span class="bi-list"></span>
          </a>
        </div>
      </nav>
    <!-- navbar -->

    <!-- sidebar -->

    <div class="offcanvas offcanvas-start sidebar bg-cool-gray-900" tabindex="-1" id="sidebar">
      <div class="offcanvas-body text-sm-start">
      <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="warm-gray-50 small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
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
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
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
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Residents</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Blotter Records</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li>
              <a
                class="nav-link px-3 sidebar-link"
                data-bs-toggle="collapse"
                href="#issuance"
              >
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Issuances</span>
                <span class="ms-auto">
                  <span class="right-icon">
                    <i class="bi bi-chevron-down"></i>
                  </span>
                </span>
              </a>
              <div class="collapse" id="issuance">
                <ul class="navbar-nav ps-3">
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Settlement Records</span>
                    </a>
                  </li>
                  <li>
                    <a href="#" class="nav-link px-3">
                      <span class="me-2"
                        ><i class="bi bi-speedometer2"></i
                      ></span>
                      <span>Issue Certificate</span>
                    </a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="my-2"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="warm-gray-50 small fw-bold text-uppercase px-3">
                Admin
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-graph-up"></i></span>
                <span>Accounts</span>
              </a>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-table"></i></span>
                <span>Config</span>
              </a>
            </li>
          </ul>
      </div>
    </div>

    <!-- sidebar -->

    
    <!-- main content -->
      <main>

      </main>
    <!-- main content -->

</body>
</html>
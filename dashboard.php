<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/styles.css">

    <script src="scripts/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <section>
        <nav class="sidenav navbar-expand d-flex flex-column align-items-start" id="sidebar">
            <a href="#" class="navbar-brand ps-4">
                <div class=" display-5 text-center fw-bolder text-light">HOME</div>
            </a>
            <ul class="navbar-nav d-flex flex-column mt-5 w-100 ">
                <li class="nav-item w-100">
                    <a href="#" class="sidenav-link nav-link text-light ps-4"><i class="far fa-address-card pe-2"></i>item</a>
                </li>
                <li class="nav-item w-100">
                    <a href="#" class="sidenav-link nav-link text-light ps-4"><i class="far fa-address-card pe-2"></i>item</a>
                </li>
                <li class="nav-item w-100">
                    <a href="#" class="sidenav-link nav-link text-light ps-4"><i class="far fa-address-card pe-2"></i>item</a>
                </li>
                <li class="nav-item w-100">
                    <a href="#" class="sidenav-link nav-link text-light ps-4"><i class="far fa-address-card pe-2"></i>item</a>
                </li>
            </ul>
        </nav>
    </section>

    <section class="open">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
            <div class="container-fluid">
                <button class="btn navbar-brand" id="toggle-btn"><i class="fas fa-bars"></i></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item me-auto">
                    <a class="nav-link" href="#">Link</a>
                    </li>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                </div>
            </div>
        </nav>

        <section>
            <!-- include content here -->
            <!-- <?php include 'footer.php';?> -->
            <div class="display-1"><i class="far fa-smile rotate"></i></i></div>
        </section>
    </section>

    



    <script>
        var menu_btn = document.querySelector("#toggle-btn")
        var sidebar = document.querySelector("#sidebar")
        var container = document.querySelector(".open")
        menu_btn.addEventListener("click", () => {
            sidebar.classList.toggle("active-nav")
            container.classList.toggle("active-cont")
        })
    </script>
    
</body>
</html>
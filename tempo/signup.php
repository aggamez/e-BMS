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
    <title>Register</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles/bootstrap.min.css">
    <link rel="stylesheet" href="styles/universals.css">
    <link rel="stylesheet" href="styles/register.css">

    <script type="text/javascript" src="scripts/js/bootstrap.bundle.min.js"></script>
    <script src="scripts/js/actions.js"></script>
</head>

<body>
    <div class="origin d-flex align-items-center justify-content-center">
        <div class="w-75 p-3 bg-red-200 rounded-3 d-flex align-items-center justify-content-center">
            <form 
                name="regForm"
                action="#" 
                method="post"
                onsubmit="return registerAccount()"
                class="d-grid gap-2"
            >
                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-12">
                        <h2 class="text-center poppins-700">
                            Create account
                        </h2>
                    </div>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-card-text"></i>                   
                                </div>
                                <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                                id="firstName" name="firstName" placeholder="First Name" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-card-heading"></i>                   
                                </div>
                                <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                                id="lastName" name="lastName" placeholder="Last Name" >
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center m-0 w-100">
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-person-circle"></i>                   
                                </div>
                                <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="studNumber" name="studNumber"
                                maxlength="11" placeholder="Student Number">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group d-flex justify-content-center align-content-center m-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-calendar3-fill"></i>                   
                                </div>
                            </div>
                            <select class="custom-select w-100 rounded-0 bg-gray-50 rounded-end border-2 bd-light-pink-500 inter-500 px-1" 
                            data-width="100%" id="yearLevel" name="yearLevel" >
                                <option value="0" selected>Year Level</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center m-0 w-100">
                    <div class="col-12">
                        <div class="form-group d-flex justify-content-center align-content-center m-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-mortarboard-fill"></i>                   
                                </div>
                            </div>
                            <select class="custom-select bg-gray-50 rounded-0 rounded-end border-2 bd-light-pink-500 inter-500 px-1" 
                            data-width="css-width" data-live-search="true" id="program" name="program" >
                                <option value="0" selected>Program</option>
                                <option value="BSCE">Bachelor of Science in Civil Engineering</option>
                                <option value="BSCPE">Bachelor of Science in Computer Engineering</option>
                                <option value="BSEE">Bachelor of Science in Electrical Engineering</option>
                                <option value="BSME">Bachelor of Science in Mechanical Engineering</option>
                                <option value="BSCS">Bachelor of Science in Computer Science</option>
                                <option value="BSDS">Bachelor of Science in Data Science</option>
                                <option value="BSEMC-DA">Bachelor of Science in Entertainment and Multimedia Computing, major in Digital Animation</option>
                                <option value="BSEMC-GD">Bachelor of Science in Entertainment and Multimedia Computing, major in Game Development</option>
                                <option value="BSIT">Bachelor of Science in Information Technology</option>
                                <option value="BSIS">Bachelor of Science in Information Science</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-md-8">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-at"></i>                   
                                </div>
                                <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                                id="email" name="email" placeholder="E-Mail Address" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-telephone-fill"></i>                   
                                </div>
                                <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="contact" name="contact" 
                                maxlength="11" placeholder="Contact Number">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-md-6">
                        <div class="form-group d-flex justify-content-center align-content-center m-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-mortarboard-fill"></i>                   
                                </div>
                            </div>
                            <select class="custom-select bg-gray-50 rounded-0 rounded-end border-2 bd-light-pink-500 inter-500 px-1" 
                            data-width="css-width" data-live-search="true" id="sex" name="sex" >
                                <option value="0" selected>Sex</option>
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                                <option value="U">Prefer not to say</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                    <i class="bi bi-calendar2-event-fill"></i>                   
                                </div>
                                <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="datemax" 
                                name="datemax" max="2003-11-01" onfocus="(this.type='date')" placeholder="Birth Date" >
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                    <div class="col-md-12">
                        <div class="input-group">
                            <div class="input-group-text bg-gray-300 border-2 bd-light-pink-500">
                                <input type="checkbox" class="form-control t" name="t" id="t" data-bs-toggle="modal" 
                                data-bs-target="#tnc-modal"/>
                                <label for="t" class="bi bi-file-text-fill"></label>
                            </div>
                            <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="" name="" value="You must have read the Terms and Conditions. (Click icon to read)"
                            readonly="readonly" disabled="disabled"> 
                        </div>
                    </div>
                </div>

                <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
                        <button type="submit" name="register"
                        class="btn bg-blue-500 border border-2 bd-blue-700 w-auto text-center oxygen-400">Register</button>
                </div>

            </form>
        
        </div>
    </div>


    <div class="modal fade" id="tnc-modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title poppins-500" id="exampleModalLabel">Terms and Conditions</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="inter-300">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. 
                    Eget arcu dictum varius duis at consectetur lorem donec. Faucibus nisl tincidunt eget nullam non nisi. 
                    Sit amet venenatis urna cursus eget nunc scelerisque. Suspendisse interdum consectetur libero id faucibus nisl. 
                    Eu augue ut lectus arcu bibendum at varius. Nunc lobortis mattis aliquam faucibus purus in massa. 
                    Nulla porttitor massa id neque aliquam vestibulum. Quam elementum pulvinar etiam non quam lacus. 
                    Quam id leo in vitae turpis massa sed. Sit amet nisl suscipit adipiscing bibendum est ultricies integer. 
                    Volutpat odio facilisis mauris sit amet massa vitae tortor condimentum. Nulla facilisi etiam dignissim diam quis. 
                    Ullamcorper velit sed ullamcorper morbi tincidunt ornare massa. Et odio pellentesque diam volutpat commodo sed egestas. 
                    Molestie a iaculis at erat. Eget felis eget nunc lobortis mattis.
                </p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn bg-gray-250 oxygen-400" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn bg-green-500 gray-50 oxygen-400" data-bs-dismiss="modal">Accept</button>
            </div>
        </div>
    </div>


</body>




</html>
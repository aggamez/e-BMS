<?php
    include "config.php";

    $id = $_POST['uid'];
    
    $data = $dconn -> query("SELECT * from data WHERE id = $id");
    while($row = $data -> fetch_assoc()) {
?>

    <div class="p-2 d-grid gap-2 align-items-center justify-content-center">

        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control border-2 bd-light-pink-500 studentNumber inter-500" value="<?php echo $row['id']?>" name="id" placeholder="id" hidden>
            </div>
        </div>


        <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                            <i class="bi bi-card-text"></i>                   
                        </div>
                        <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500 px-2" 
                                id="firstName" name="firstName" placeholder="First Name" value="<?php echo $row['firstName']?>" 
                                disabled>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                            <i class="bi bi-card-heading"></i>                   
                        </div>
                        <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500 px-2" 
                                id="lastName" name="lastName" placeholder="First Name" value="<?php echo $row['lastName']?>" 
                                disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container-fluid d-flex justify-content-center align-content-center m-0 w-100">
            <div class="col-lg-8 col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                <i class="bi bi-person-circle"></i>                   
                        </div>
                            <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500 px-2" id="studNumber" name="studNumber"
                            maxlength="11" placeholder="Student Number" value="<?php echo $row['studNumber']?>" disabled>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="form-group d-flex justify-content-center align-content-center m-0">
                    <div class="input-group-prepend">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                            <i class="bi bi-calendar3-fill"></i>                   
                        </div>
                    </div>
                    <input type="text" class="form-control rounded-0 rounded-end bg-gray-50 border-2 bd-light-pink-500 inter-500 px-2" id="yearLevel" name="yearLevel"
                        maxlength="1" placeholder="Year Level" value="<?php echo $row['yearLevel']?>" disabled>
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
                    <select class="custom-select form-control bg-gray-50 rounded-0 rounded-end border-2 bd-light-pink-500 inter-500 px-2" 
                            data-width="100%" data-live-search="true" id="program" name="program" disabled>
                                <option value="0"       <?php if ($row['program'] == '0') echo ' selected="selected"'; ?>>Program</option>
                                <option value="BSCE"    <?php if ($row['program'] == 'BSCE') echo ' selected="selected"'; ?>>Bachelor of Science in Civil Engineering</option>
                                <option value="BSCPE"   <?php if ($row['program'] == 'BSCPE') echo ' selected="selected"'; ?>>Bachelor of Science in Computer Engineering</option>
                                <option value="BSEE"    <?php if ($row['program'] == 'BSEE') echo ' selected="selected"'; ?>>Bachelor of Science in Electrical Engineering</option>
                                <option value="BSME"    <?php if ($row['program'] == 'BSME') echo ' selected="selected"'; ?>>Bachelor of Science in Mechanical Engineering</option>
                                <option value="BSCS"    <?php if ($row['program'] == 'BSCS') echo ' selected="selected"'; ?>>Bachelor of Science in Computer Science</option>
                                <option value="BSDS"    <?php if ($row['program'] == 'BSDS') echo ' selected="selected"'; ?>>Bachelor of Science in Data Science</option>
                                <option value="BSEMC-DA"<?php if ($row['program'] == 'BSEMC-DA') echo ' selected="selected"'; ?>>Bachelor of Science in Entertainment and Multimedia Computing, major in Digital Animation</option>
                                <option value="BSEMC-GD"<?php if ($row['program'] == 'BSEMC-GD') echo ' selected="selected"'; ?>>Bachelor of Science in Entertainment and Multimedia Computing, major in Game Development</option>
                                <option value="BSIT"    <?php if ($row['program'] == 'BSIT') echo ' selected="selected"'; ?>>Bachelor of Science in Information Technology</option>
                                <option value="BSIS"    <?php if ($row['program'] == 'BSIS') echo ' selected="selected"'; ?>>Bachelor of Science in Information Science</option>
                            </select>
                </div>
            </div>
        </div>

        <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
            <div class="col-lg-8 col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                            <i class="bi bi-at"></i>                   
                        </div>
                            <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500 px-2" 
                            id="email" name="email" placeholder="E-Mail Address" value="<?php echo $row['email']?>" disabled>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                            <i class="bi bi-telephone-fill"></i>                   
                        </div>
                        <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500 px-2" id="contact" name="contact" 
                            maxlength="11" placeholder="Contact Number" value="<?php echo $row['contactNumber']?>" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container-fluid d-flex justify-content-center align-content-center m-0">
            <div class="col-lg-6 col-md-12">
                <div class="form-group d-flex justify-content-center align-content-center m-0">
                    <div class="input-group-prepend">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                            <i class="bi bi-person-bounding-box"></i>                   
                        </div>
                    </div>
                    <select class="custom-select form-control bg-gray-50 rounded-0 rounded-end border-2 bd-light-pink-500 inter-500 px-2" 
                            data-width="100%" data-live-search="true" id="sex" name="sex" disabled>
                                <option value="0" <?php if ($row['sex'] == '0') echo ' selected="selected"'; ?>>Sex</option>
                                <option value="M" <?php if ($row['sex'] == 'M') echo ' selected="selected"'; ?>>Male</option>
                                <option value="F" <?php if ($row['sex'] == 'F') echo ' selected="selected"'; ?>>Female</option>
                                <option value="U" <?php if ($row['sex'] == 'U') echo ' selected="selected"'; ?>>Prefer not to say</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                            <i class="bi bi-calendar2-event-fill"></i>                   
                        </div>
                        <input type="date" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="datemax" 
                            name="datemax" max="2003-11-01" value="<?php echo $row['birthDate']?>" disabled>
                    </div>
                </div>
            </div>
        </div>

        <div class="row container-fluid d-flex justify-content-center align-content-center m-0 w-100">
                <div class="col-12">
                    <div class="form-group d-flex justify-content-center align-content-center m-0">
                        <div class="input-group-prepend">
                            <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                <i class="bi bi-shield-lock-fill"></i>                   
                            </div>
                        </div>
                        <input type="text" class="form-control rounded-0 rounded-end bg-gray-50 border-2 bd-light-pink-500 inter-500 px-2" id="pass" name="pass" 
                             placeholder="Password" value="<?php echo $row['pass']?>" disabled>
                    </div>
                </div>
            </div>

    </div>
<?php } ?>
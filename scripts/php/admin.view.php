<?php
    include "admin.config.php";

    $id = $_POST['uid'];


    $admin = $aconn -> query("SELECT * from admin WHERE adminID = '$id'") or die($aconn -> error);
    while($row = $admin -> fetch_assoc()) { 
        ?>

            <form
                name="viewAdmin"
                action="#" 
                method="post"
                onsubmit=""
                class="d-grid gap-4"
                >
                <div class="row">

                  <div class="col-lg-6">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="familyName" name="familyName" placeholder="Family Name" value="<?php echo $row['resFamName'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="givenName" name="givenName" placeholder="Given Name"  value="<?php echo $row['resGivenName'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="middleName" name="middleName" placeholder="Middle Name"  value="<?php echo $row['resMiddleName'] ?>" readonly>
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="container d-flex flex-column gap-1">
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="alias" name="alias" placeholder="Alias" value="<?php echo $row['resID'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="adminName" 
                                name="adminName"  placeholder="username" value="<?php echo $row['adminName'] ?>" readonly>
                      </div>
                      
                          <div class="input-group">
                            <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                                <i class="bi bi-card-text"></i>                   
                            </div>
                            <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="purok" name="purok" disabled>
                                <?php 
                                include 'scripts/php/admin.actions.php';

                                $positions = $aconn -> query("SELECT * from purok") or die(mysqli_error($aconn));
                                while ($data = $positions -> fetch_assoc()): ?>
                                <option value="<?php echo $data['id'];?>" <?php if($row['position'] == $data['name']) echo ' selected="selected"'; ?>><?php echo $data['name'];?></option>
                                <?php endwhile;?>
                            </select>
                      </div> 
                      </div>
                    </div>
                  </div>
                </div>

            </form>
    
<?php } ?>
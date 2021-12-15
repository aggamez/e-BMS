<?php
    include "admin.config.php";

    $id = $_POST['uid'];

    $resi = $aconn -> query("SELECT * from residents WHERE id = '$id'");
    while($row = $resi -> fetch_assoc()) {
?>
    <form
                name="viewResident"
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
                        <div id="preview" class="logo border border-1 bd-true-gray-900">
                          <img class="image" src="<?php echo $row['resImg'] ?>" width="200" height="200">
                        </div>
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
                          id="familyName" name="familyName" placeholder="Family Name" value="<?php echo $row['familyName'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="givenName" name="givenName" placeholder="Given Name"  value="<?php echo $row['givenName'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="middleName" name="middleName" placeholder="Middle Name"  value="<?php echo $row['middleName'] ?>" readonly>
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
                          id="alias" name="alias" placeholder="Alias" value="<?php echo $row['alias'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="date" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="birthDate" 
                                name="birthDate"  placeholder="Birth Date" value="<?php echo $row['birthDate'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="birthPlace" name="birthPlace" placeholder="Birth Place" value="<?php echo $row['birthPlace'] ?>" readonly>
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
                             data-live-search="true" id="sex" name="sex" disabled>
                                <option value="0" <?php if ($row['sex'] == '0') echo ' selected="selected"'; ?>>Sex</option>
                                <option value="M" <?php if ($row['sex'] == 'M') echo ' selected="selected"'; ?>>Male</option>
                                <option value="F" <?php if ($row['sex'] == 'F') echo ' selected="selected"'; ?>>Female</option>
                            </select>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="faceMarks" name="faceMarks" placeholder="Face Marks" value="<?php echo $row['faceMarks'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="faith" name="faith" placeholder="Religion / Belief" value="<?php echo $row['faith'] ?>" readonly>
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
                          id="nationality" name="nationality" placeholder="Nationality" value="<?php echo $row['nationality'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="occupation" name="occupation" placeholder="Occupation" value="<?php echo $row['occupation'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="sector" name="sector" disabled>
                                <option value="000" <?php if ($row['sector'] == '000') echo ' selected="selected"'; ?>>Sector</option>
                                <option value="PRI" <?php if ($row['sector'] == 'PRI') echo ' selected="selected"'; ?>>Private</option>
                                <option value="PUB" <?php if ($row['sector'] == 'PUB') echo ' selected="selected"'; ?>>Public</option>
                                <option value="GOV" <?php if ($row['sector'] == 'GOV') echo ' selected="selected"'; ?>>Government</option>
                                <option value="UNM" <?php if ($row['sector'] == 'UNM') echo ' selected="selected"'; ?>>Unemployed</option>
                                <option value="OSY" <?php if ($row['sector'] == 'OSY') echo ' selected="selected"'; ?>>Out of School Youth</option>
                                <option value="OSC" <?php if ($row['sector'] == 'OSC') echo ' selected="selected"'; ?>>Out of School Childre</option>
                                <option value="PWD" <?php if ($row['sector'] == 'PWD') echo ' selected="selected"'; ?>>Person with Disability</option>
                                <option value="SEC" <?php if ($row['sector'] == 'SEC') echo ' selected="selected"'; ?>>Senior Citizen</option>
                                <option value="OFW" <?php if ($row['sector'] == 'OFW') echo ' selected="selected"'; ?>>Overseas Filipino Worker</option>
                                <option value="SLP" <?php if ($row['sector'] == 'SLP') echo ' selected="selected"'; ?>>Solo Parent</option>
                                <option value="INP" <?php if ($row['sector'] == 'INP') echo ' selected="selected"'; ?>>Indigenous People</option>
                                <option value="OTH" <?php if ($row['sector'] == 'OTH') echo ' selected="selected"'; ?>>Others</option>
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
                             data-live-search="true" id="civilStatus" name="civilStatus" disabled>
                                <option value="0" <?php if ($row['civilStatus'] == '0') echo ' selected="selected"'; ?>>Civil Status</option>
                                <option value="S" <?php if ($row['civilStatus'] == 'S') echo ' selected="selected"'; ?>>Single</option>
                                <option value="M" <?php if ($row['civilStatus'] == 'M') echo ' selected="selected"'; ?>>Married</option>
                                <option value="X" <?php if ($row['civilStatus'] == 'X') echo ' selected="selected"'; ?>>Separated</option>
                                <option value="W" <?php if ($row['civilStatus'] == 'W') echo ' selected="selected"'; ?>>Widowed</option>
                            </select>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" id="spouseName" 
                                name="spouseName" placeholder="Spouse Name" value="<?php echo $row['spouseName'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="spouseOccu" name="spouseOccu" placeholder="Spouse Occupation" value="<?php echo $row['spouseOccu'] ?>" readonly>
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
                          id="cityAdd" name="cityAdd" placeholder="City Address" value="<?php echo $row['cityAdd'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="provAdd" name="provAdd" placeholder="Provincial Address" value="<?php echo $row['provAdd'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <select class="custom-select w-auto rounded-0 rounded-end border-2 bd-light-pink-500 px-1" 
                             data-live-search="true" id="purok" name="purok" disabled>
                                <option value="0" selected>Purok</option>
                                <?php 
                                include 'scripts/php/admin.actions.php';

                                $purok = $aconn -> query("SELECT * from purok") or die(mysqli_error($aconn));
                                while ($data = $purok -> fetch_assoc()): ?>
                                <option value="<?php echo $data['id'];?>" <?php if($row['purok'] == $data['id']) echo ' selected="selected"'; ?>><?php echo $data['name'];?></option>
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
                          id="homeNumbOne" name="homeNumbOne" placeholder="Home Number One" value="<?php echo $row['homeNumbOne'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="homeNumbTwo" name="homeNumbTwo" placeholder="Home Number Two" value="<?php echo $row['homeNumbTwo'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="email" name="email" placeholder="e-Mail" value="<?php echo $row['email'] ?>" readonly>
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
                          id="mobiNumbOne" name="mobiNumbOne" placeholder="Mobile Number One" value="<?php echo $row['mobiNumbOne'] ?>" readonly>
                      </div>
                      <div class="input-group">
                          <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                              <i class="bi bi-card-text"></i>                   
                          </div>
                          <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                          id="mobiNumbTwo" name="mobiNumbTwo" placeholder="Mobile Number Two" value="<?php echo $row['mobiNumbTwo'] ?>" readonly>
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
                             data-live-search="true" id="resType" name="resType" disabled>
                                <option value="0" <?php if ($row['resType'] == '0') echo ' selected="selected"'; ?>>Resident Type</option>
                                <option value="N" <?php if ($row['resType'] == 'N') echo ' selected="selected"'; ?>>Native</option>
                                <option value="R" <?php if ($row['resType'] == 'R') echo ' selected="selected"'; ?>>Rentee</option>
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
                             data-live-search="true" id="resState" name="resState" disabled>
                                <option value="0" <?php if ($row['resState'] == '0') echo ' selected="selected"'; ?>>Resident State</option>
                                <option value="A" <?php if ($row['resState'] == 'A') echo ' selected="selected"'; ?>>Active</option>
                                <option value="I" <?php if ($row['resState'] == 'I') echo ' selected="selected"'; ?>>Inactive</option>
                                <option value="D" <?php if ($row['resState'] == 'D') echo ' selected="selected"'; ?>>Deceased</option>
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
                              data-live-search="true" id="voterState" name="voterState" disabled>
                                  <option value="0" <?php if ($row['voterState'] == '0') echo ' selected="selected"'; ?>>Voter Status</option>
                                  <option value="N" <?php if ($row['voterState'] == 'N') echo ' selected="selected"'; ?> id="VN">Not Eligible</option>
                                  <option value="A" <?php if ($row['voterState'] == 'A') echo ' selected="selected"'; ?> id="VA">Active</option>
                                  <option value="I" <?php if ($row['voterState'] == 'I') echo ' selected="selected"'; ?> id="VI">Inactive</option>
                            </select>
                      </div>
                    </div>
                  </div>
                </div>  

                

                <hr>

            </form>
    
<?php } ?>
<?php
    include "admin.config.php";

    $id = $_POST['uid'];
    
    $data = $aconn -> query("SELECT * from residents WHERE id = '$id'");
    while($user = $data -> fetch_assoc()) {

?>

                <form
                name="del"
                action="#" 
                method="post"
                onsubmit=""
                class="d-flex flex-column">

                    <div class="container my-1">
                        <h3>Delete Resident Data?
                        </h3>
                    </div>

                    <div class="form-group my-1">
                        <div class="input-group">
                            <input type="text" class="form-control border-2 bd-light-pink-500 id inter-500 visually-hidden" 
                            value="<?php echo $user['id']?>" name="id" placeholder="id">
                        </div>
                    </div>

                    <div class="container d-flex flex-row justify-content-end my-1">
                        <a href="#" class="btn bg-gray-250 oxygen-500" data-bs-dismiss="modal" name="close">Close</a>
                        <button class="btn gray-50 bg-red-600 oxygen-500 true-gray-100" type="submit" name="deleteResident">Delete</button>
                    </div>
                    
                </form>

<?php } ?>
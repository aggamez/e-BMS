<?php
    include "config.php";

    $id = $_POST['id'];
    
    $data = $dconn -> query("SELECT * from data WHERE id = $id");
    while($user = $data -> fetch_assoc()) {
?>

                <form
                    name="delUser"
                    action="<?php $_SERVER['PHP_SELF'] ?>" 
                    method="post"
                    onsubmit="">
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control border-2 bd-light-pink-500 studentNumber inter-500" value="<?php echo $user['id']?>" name="id" placeholder="id" hidden>
                        </div>
                    </div>

                    <a href="#" class="btn bg-gray-250 oxygen-500" data-bs-dismiss="modal" name="close">Close</a>
                    <button class="btn gray-50 bg-red-600 oxygen-500" type="submit" name="delete">Delete</button>
                </form>

<?php } ?>
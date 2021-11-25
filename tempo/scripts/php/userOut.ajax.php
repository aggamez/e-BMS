<?php
    include "config.php";

    $id = $_POST['id'];
    
    $data = $dconn -> query("SELECT * from data WHERE id = $id");
    while($row = $data -> fetch_assoc()) {
?>

                <form
                    name="log-off"
                    action="<?php $_SERVER['PHP_SELF'] ?>" 
                    method="post"
                    onsubmit="">

                    <a href="#" class="btn bg-gray-250 oxygen-500" data-bs-dismiss="modal" name="close">Close</a>
                    <button class="btn gray-50 bg-red-600 oxygen-500" type="submit" name="log-off">Log Out</button>
                </form>

<?php } ?>
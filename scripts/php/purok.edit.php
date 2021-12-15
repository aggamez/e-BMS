<?php
    include "admin.config.php";

    $id = $_POST['uid'];

    $data = $aconn -> query("SELECT * from purok WHERE id = '$id'");
    while($row = $data -> fetch_assoc()) {

    
?>
    <form
                name="edit"
                action="#" 
                method="post"
                onsubmit=""
                class="d-flex flex-column"
                >
                <div class="input-group">
                    <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500 disabled visually-hidden" 
                    id="id" name="id" placeholder="Purok ID" value="<?php echo $row['id']?>">
                    <div class="input-group-text rounded-0 rounded-start bg-gray-300 border-2 bd-light-pink-500">
                        <i class="bi bi-card-text"></i>                   
                    </div>
                    <input type="text" class="form-control bg-gray-50 border-2 bd-light-pink-500 inter-500" 
                    id="name" name="name" placeholder="Purok Name" value="<?php echo $row['name']?>">
                </div>

                <div class="d-flex justify-content-center align-items-center mt-3">
                        <button type="submit" name="editPurok"
                        class="btn bg-blue-400 border w-auto text-center">Edit Purok</button>
                </div>
    </form>
    
<?php } ?>
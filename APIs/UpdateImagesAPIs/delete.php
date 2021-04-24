<?php
    include("../include/dbConnection.php");
    if(isset($_POST['image_id'])) {
        if($_POST['image_id'] != ''){
            $image_id = $conn->real_escape_string($_POST["image_id"]);

            $query = "DELETE FROM images WHERE image_id = '".$image_id."'";
            if(mysqli_query($conn, $query)){
                echo 'Image Supprimée';
            }
        }
    }
?>
<?php
    include("../include/dbConnection.php");
    if(isset($_POST["image_id"])) {
        $query = "SELECT * FROM images WHERE image_id = '".$_POST["image_id"]."'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            $output["image"] = $row["image"];
        }
        echo json_encode($output);
    }
?>
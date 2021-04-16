<?php
    include('../APIs/include/dbConnection.php');

    if (isset($_GET['id']) ){
        $id = intval($_GET['id']);
        $stmt = $conn -> prepare('SELECT img_id, img_type, img_blob FROM images WHERE img_id = ?');
        $stmt -> bind_param('i',$id);
        $stmt -> execute();
        $result = $stmt->get_result();

        if($result->num_rows === 0) exit('No rows');
        if (!$col[0]){
            echo "Id d'image inconnu";
        } else {
            header ("Content-type: " . $col[1]);
            echo $col[2];
        }

        $stmt -> close();
        $conn -> close();
    } else {
        echo "Mauvais id d'image";
    }
?>
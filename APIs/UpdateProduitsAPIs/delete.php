<?php
    include("../include/dbConnection.php");
    if(isset($_POST['product_id'])) {
        if($_POST['product_id'] != ''){
            $product_id = $conn->real_escape_string($_POST["product_id"]);

            $query = "DELETE FROM products WHERE product_id = '".$product_id."'";
            if(mysqli_query($conn, $query)){
                echo 'Produit Supprimé';
            }
        }
    }
?>
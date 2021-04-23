<?php
    include("../include/dbConnection.php");
    if(isset($_POST["operation"])){
        if($_POST["operation"] == "Add"){
            $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
            $quant_available = mysqli_real_escape_string($conn, $_POST["quant_available"]);
            $description = mysqli_real_escape_string($conn, $_POST["description"]);
            $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
            $price = mysqli_real_escape_string($conn, $_POST["price"]);
            $image_id = mysqli_real_escape_string($conn, $_POST["image_id"]);

            $query = "INSERT INTO products(product_name, quant_available, description, price, category_id, image_id)
            VALUES ('".$product_name."', '".$quant_available."', '".$description."', '".$price."', '".$category_id."', '".$image_id."')";

            if(mysqli_query($conn, $query)){
                echo 'Produit Ajouté';
            }
        }
        if($_POST["operation"] == "Edit"){
            $product_name = mysqli_real_escape_string($conn, $_POST["product_name"]);
            $quant_available = mysqli_real_escape_string($conn, $_POST["quant_available"]);
            $description = mysqli_real_escape_string($conn, $_POST["description"]);
            $category_id = mysqli_real_escape_string($conn, $_POST["category_id"]);
            $price = mysqli_real_escape_string($conn, $_POST["price"]);
            $image_id = mysqli_real_escape_string($conn, $_POST["image_id"]);

            $query = "UPDATE products
            SET product_name = '".$product_name."',
            quant_available = '".$quant_available."',
            description = '".$description."',
            price = '".$price."',
            category_id = '".$category_id."',
            image_id = '".$image_id."'
            WHERE product_id = '".$_POST["product_id"]."'";

            if(mysqli_query($conn, $query)){
                echo 'Produit Modifié';
            }
        }
    }
?>

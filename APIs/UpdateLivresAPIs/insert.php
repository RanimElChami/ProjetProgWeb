<?php
    include("../include/dbConnection.php");
    if(isset($_POST["operation"])){
        if($_POST["operation"] == "Add"){
            $book_name = mysqli_real_escape_string($conn, $_POST["book_name"]);
            $quant_available = mysqli_real_escape_string($conn, $_POST["quant_available"]);
            $author = mysqli_real_escape_string($conn, $_POST["author"]);
            $pub_date = mysqli_real_escape_string($conn, $_POST["pub_date"]);
            $price = mysqli_real_escape_string($conn, $_POST["price"]);
            $image_id = mysqli_real_escape_string($conn, $_POST["image_id"]);

            $query = "INSERT INTO books(book_name, quant_available, author, price, pub_date, image_id)
            VALUES ('".$book_name."', '".$quant_available."', '".$author."', '".$price."', '".$pub_date."', '".$image_id."')";

            if(mysqli_query($conn, $query)){
                echo 'Livre Ajouté';
            }
        }
        if($_POST["operation"] == "Edit"){
            $book_name = mysqli_real_escape_string($conn, $_POST["book_name"]);
            $quant_available = mysqli_real_escape_string($conn, $_POST["quant_available"]);
            $author = mysqli_real_escape_string($conn, $_POST["author"]);
            $pub_date = mysqli_real_escape_string($conn, $_POST["pub_date"]);
            $price = mysqli_real_escape_string($conn, $_POST["price"]);
            $image_id = mysqli_real_escape_string($conn, $_POST["image_id"]);

            $query = "UPDATE books
            SET book_name = '".$book_name."',
            quant_available = '".$quant_available."',
            author = '".$author."',
            price = '".$price."',
            pub_date = '".$pub_date."',
            image_id = '".$image_id."'
            WHERE book_id = '".$_POST["book_id"]."'";

            if(mysqli_query($conn, $query)){
                echo 'Livre Modifié';
            }
        }
    }
?>

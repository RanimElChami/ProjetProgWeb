<?php
    include("../include/dbConnection.php");
    if(isset($_POST['book_id'])) {
        if($_POST['book_id'] != ''){
            $book_id = $conn->real_escape_string($_POST["book_id"]);

            $query = "DELETE FROM books WHERE book_id = '".$book_id."'";
            if(mysqli_query($conn, $query)){
                echo 'Produit Supprimé';
            }
        }
    }
?>
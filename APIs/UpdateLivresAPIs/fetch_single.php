<?php
    include("../include/dbConnection.php");
    if(isset($_POST["book_id"])) {
        $query = "SELECT * FROM books WHERE book_id = '".$_POST["book_id"]."'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            $output["pub_date"] = $row["pub_date"];
            $output["book_name"] = $row["book_name"];
            $output["price"] = $row["price"];
            $output["author"] = $row["author"];
            $output["quant_available"] = $row["quant_available"];
            $output["image_id"] = $row["image_id"];
        }
        echo json_encode($output);
    }
?>
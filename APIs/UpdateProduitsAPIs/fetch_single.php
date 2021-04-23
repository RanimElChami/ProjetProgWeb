<?php
    include("../include/dbConnection.php");
    if(isset($_POST["product_id"])) {
        $query = "SELECT * FROM products WHERE product_id = '".$_POST["product_id"]."'";
        $result = mysqli_query($conn, $query);
        while($row = mysqli_fetch_array($result)){
            $output["category_id"] = $row["category_id"];
            $output["product_name"] = $row["product_name"];
            $output["price"] = $row["price"];
            $output["description"] = $row["description"];
            $output["quant_available"] = $row["quant_available"];
            $output["image_id"] = $row["image_id"];
        }
        echo json_encode($output);
    }
?>
<?php
    include('include/dbConnection.php');
    $productsArray = array();

    $stmt = $conn -> prepare('SELECT p.*, i.image FROM products p
    JOIN images i ON i.image_id = p.image_id');
    $stmt -> execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        exit('No rows');
    }
    while($row = $result->fetch_assoc()) {
        $productsArray[] = $row;
    }

    $stmt -> close();
    $conn -> close();
?>
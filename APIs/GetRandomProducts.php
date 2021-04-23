<?php
    include('include/dbConnection.php');
    $randomProducts = array();

    $stmt = $conn -> prepare('SELECT p.*, i.image FROM products p
    JOIN images i ON i.image_id = p.image_id
    ORDER BY RAND() LIMIT 3');
    $stmt -> execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        exit('No rows');
    }
    while($row = $result->fetch_assoc()) {
        $randomProducts[] = $row;
    }

    $stmt -> close();
    $conn -> close();
?>
<?php
    include('include/dbConnection.php');
    $booksArray = array();

    $stmt = $conn -> prepare('SELECT b.*, i.image FROM books b
    JOIN images i ON i.image_id = b.image_id');
    $stmt -> execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        exit('No rows');
    }
    while($row = $result->fetch_assoc()) {
        $booksArray[] = $row;
    }

    $stmt -> close();
    $conn -> close();
?>
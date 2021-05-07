<?php
    include('include/dbConnection.php');
    $randomBooks = array();

    $stmt2 = $conn -> prepare('SELECT b.*, i.image FROM books b
    JOIN images i ON i.image_id = b.image_id
    ORDER BY RAND() LIMIT 3');
    $stmt2 -> execute();
    $result2 = $stmt2->get_result();
    if ($result2->num_rows === 0) {
        exit('No rows');
    }
    while($row2 = $result2->fetch_assoc()) {
        $randomBooks[] = $row2;
    }

    $stmt2 -> close();
    $conn -> close();
?>
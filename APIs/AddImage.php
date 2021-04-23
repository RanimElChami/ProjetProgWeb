<?php
    include('include/dbConnection.php');

    // If upload button is clicked
    if (isset($_POST['upload'])) {
        // Get image name
        $image = $_FILES['image']['name'];

        // Image file directory
        $target = "./images/".basename($image);

        $stmt = $conn -> prepare('INSERT INTO images (image) VALUES (?)');
        $stmt -> bind_param('s', $image);
        $stmt -> execute();
        $stmt -> close();

        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    }
?>
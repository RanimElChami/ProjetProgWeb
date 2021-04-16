<!DOCTYPE html>
<html>

<head>
    <title>Produits</title>
    <?php include('layout/Header.php')?>
    <link rel="stylesheet" href="css/produit.css"/>
</head>

<body>
    <?php
        include('../APIs/include/dbConnection.php');
        $stmt = $conn -> prepare('SELECT img_nom, img_id FROM images ORDER BY img_nom');
        $stmt -> execute();
        $result = $stmt->get_result();
        if($result->num_rows === 0) exit('No rows');
        while($row = $result->fetch_assoc()) {
            echo "<a href=\"apercu.php?id=" . $col[1] . "\">" . $col[0] . "</a><br />";
        }
        $stmt -> close();
        $conn -> close();
    ?>
</body>

</html>
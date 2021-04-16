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
        $req = "SELECT img_nom, img_id " .
                "FROM images ORDER BY img_nom";
        $ret = mysqli_query($req) or die(mysqli_error());
        while ($col = mysqli_fetch_row($ret)){
            echo "<a href=\"apercu.php?id=" . $col[1] . "\">" . $col[0] . "</a><br />";
        }
    ?>
</body>

</html>
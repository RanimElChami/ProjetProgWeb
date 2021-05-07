<!DOCTYPE html>

<head>
    <title>Livres</title>
    <?php include('layout/Header.php');?>
    <?php include ('../APIs/include/dbConnection.php'); ?>
    <link rel="stylesheet" href="css/produit.css"/>
</head>


<body>
    <?php  include('layout/Menu.php'); ?>

    <div class="banner">
        <h2>Nos Livres</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="10vw" viewBox="0 0 1280 140" preserveAspectRatio="none">
            <g fill="#ffffff">
                <path d="M1280 3.4C1050.59 18 1019.4 84.89 734.42 84.89c-320 0-320-84.3-640-84.3C59.4.59 28.2 1.6 0 3.4V140h1280z" fill-opacity=".3"/>
                <path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V140H0z" fill-opacity=".5"/>
                <path d="M1280 51.76c-201 12.49-242.43 53.4-513.58 53.4-320 0-320-57-640-57-48.85.01-90.21 1.35-126.42 3.6V140h1280z"/>
            </g>
        </svg>
    </div>

    <section class="liste-produits">
        <div class="container">
            <!-- Livres -->
            <?php
                $sql="SELECT * FROM books as b, images as i WHERE b.image_id=i.image_id ";
                $result= mysqli_query($conn,$sql);
                while($show=mysqli_fetch_array($result)){
            ?>
            <div class="product-div">
                <div class="product-image">
                     <img src='./images/<?php echo $show["image"]?>' alt='./images/<?php echo $show["image"]?>' />
                </div>
                <div class="product-details">
                    <h5><?php echo  $show['book_name']?></h5>
                        <p class="left-aligned-details-livre"><?php echo  $show['author']?></p>
                        <p class="right-aligned-details-livre"><?php echo  $show['pub_date']?></p>
                        <p class="left-aligned-details-livre">Ref. 00<?php echo  $show['book_id']?> </p>
                        <p class="right-aligned-details-livre"><b><?php echo  $show['price']?> &euro; </b></p>
                </div>
            </div>
            <?php
                }
            ?>

        </div>

    </section>



    <?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>
</body>
</html>

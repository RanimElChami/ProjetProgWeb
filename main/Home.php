<?php
    session_start();
?>
<!DOCTYPE html>

<head>
    <title>Accueil</title>
    <?php include('layout/Header.php')?>
    <?php include ('../APIs/include/dbConnection.php'); ?>
    <?php include ('../APIs/GetRandomProducts.php'); ?>
    <?php include ('../APIs/GetRandomBooks.php'); ?>
	<link rel="stylesheet" href="css/produit-livre.css"/>
	<link rel="stylesheet" href="css/swiper-bundle.min.css"/>
</head>

<body>
	<?php include('layout/Menu.php'); ?>

	<!-- Swiper -->
  	<div class="swiper-container" >
	    <div class="swiper-wrapper">
	      <div class="swiper-slide"><img src='./images/shakespeare_cobookshop-c-csjpg.jpg' alt='Shakespeare and Company' /></div>
	      <div class="swiper-slide"><img src='./images/Shakespeare_and_Company_bookstore.png' alt='Shakespeare and Company' /></div>
	      <div class="swiper-slide"><img src='./images/57c5b7f71a3d28a1e564cfbb0e23ce0f.jpg' alt='Shakespeare and Company' /></div>
	      <div class="swiper-slide"><img src='./images/shandco4.jpg' alt='Shakespeare and Company' /></div>
	    </div>
    	<div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
  	</div>

    <section class="about-us">
        <div class="container">
            <div class="about-us-titre">
                <h1>Qui sommes nous?</h1>
            </div>
            <div class="about-us-cont">
                <div class="about-us-img">
                    <img src="./images/Shakespeare_and_Company_bookstore.png" alt="Bookstore image"/>
                </div>
                <div class="about-us-txt">
                    <i>I created this bookstore like a man would write a novel, building each room like a chapter, and I like people to open the door the way they open a book, a book that leads into a magic world in their imaginations. —George Whitman</i>
                </div>
            </div>
  	    </div>
    </section>

  	<section class="livre-section">
        <div class="container">
            <div class="nos-livres-titre">
                <h1>Nos livres</h1>
            </div>
            <!-- Livres  -->
            <div class="nos-livres-prod">
                <?php foreach ($randomBooks as $book) {?>
                    <div class="product-div">
                        <div class="product-image">
                            <img src='./images/<?php echo $book["image"]?>' alt='./images/<?php echo $book["image"]?>' />
                        </div>

                        <div class="product-details">
                            <h5><?php echo  $book['book_name']?></h5>
                            <p class="left-aligned-details-livre"><?php echo  $book['author']?></p>
                            <p class="right-aligned-details-livre"><?php echo  $book['pub_date']?></p>
                            <p class="left-aligned-details-livre">Ref. 00<?php echo  $book['book_id']?> </p>
                            <p class="right-aligned-details-livre"><b><?php echo  $book['price']?> &euro; </b></p>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <div class="nos-livres-lien">
                <a href="./Livres.php">Découvrir plus</a>
            </div>
  	    </div>
    </section>

  	<section class="produits-section">
        <div class="container">
            <div class="nos-produits-titre">
                <h1>Nos produits</h1>
            </div>
            <div class="nos-livres-prod">
                <?php foreach ($randomProducts as $prod) { ?>
                <div class="product-div">
                    <div class="product-image">
                        <img src="./images/<?php echo $prod['image']?>" alt="./images/<?php echo $prod['image']?>" />
                    </div>
                    <div class="product-details">
                        <h5><?php echo $prod['product_name'];?></h5>
                        <p>Ref.00<?php echo $prod['product_id'];?><b> <?php echo $prod['price'];?>€</b></p>

                    </div>
                </div>
            <?php }?>
            <div class="nos-livres-lien">
                <a href="./Produits.php">Découvrir plus</a>
            </div>
        </div>
    </section>

	<?php include('layout/Footer.php'); ?>

    <script src="./js/jquery.min2.js"></script>

    <?php include('layout/BodyLinks.php'); ?>

	<!-- Initialize Swiper -->
	<script src="./js/swiper-bundle.min.js"></script>
	<script>
        var swiper = new Swiper('.swiper-container', {
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });
  	</script>
</body>
</html>
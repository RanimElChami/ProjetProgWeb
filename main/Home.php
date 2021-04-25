<!DOCTYPE html>

<head>
    <title>Accueil</title>
    <?php include('layout/Header.php')?>
    <?php include ('../APIs/include/dbConnection.php'); ?>
    <?php include ('../APIs/GetRandomProducts.php'); ?>
    <?php include ('../APIs/GetRandomBooks.php'); ?>
	<link rel="stylesheet" href="css/produit.css"/>
	<link rel="stylesheet" href="css/swiper-bundle.min.css"/>
</head>

<body>
	<?php include('layout/Menu.php'); ?>

	<!-- Swiper -->
  	<div class="swiper-container" >
	    <div class="swiper-wrapper" style="margin-top: 50px;height: 400px">
	      <div class="swiper-slide"><img src='./images/shandco2.jpg' alt='Shakespeare and Company' /></div>
	      <div class="swiper-slide"><img src='./images/shandco1.jpg' alt='Shakespeare and Company' /></div>
	      <div class="swiper-slide"><img src='./images/shandco4.jpg' alt='Shakespeare and Company' /></div>
	      <div class="swiper-slide"><img src='./images/shandco3.jpg' alt='Shakespeare and Company' /></div>
	    </div>
    	<!-- Add Pagination -->
    	<div class="swiper-pagination"></div>
  	</div>

    <section>
        <div class="container">
            <div class="about-us-titre">
                <h1>About us</h1>
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

  	<section>
        <div class="container">
            <div class="nos-livres-titre">
                <h1>Nos livres</h1>
            </div>
            <!--Livres  -->
            <div class="nos-livres-prod">
                <?php foreach ($randomBooks as $book) {?>
                    <div class="product-div">
                    <div class="product-image">
                        <img src='./images/<?php echo $book["image"]?>' alt='./images/<?php echo $book["image"]?>' />
                    </div>
                    <div class="product-details">
                        <h5><?php echo  $book['book_name']?></h5>
                        <p><?php echo  $book['author']?></p>
                        <p><?php echo  $book['pub_date']?></p>
                        <p>Ref. 00<?php echo  $book['book_id']?> <b> <?php echo  $book['price']?> &euro;</b></p>
                        <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                        <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                    </div>
                </div>
                <?php }
                ?>
            </div>
            <div class="nos-livres-lien">
                <a href="./Livres.php">Découvrir plus</a>
            </div>
  	    </div>
    </section>

  	<section>
        <div class="container">
            <div class="nos-livres-titre">
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
                        <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                        <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                    </div>
                </div>
            <?php }?>
            <div class="nos-livres-lien">
                <a href="./Produits.php">Découvrir plus</a>
            </div>
        </div>
    </section>

	<?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>

	<!-- Initialize Swiper -->
	<script src="./js/swiper-bundle.min.js"></script>
	<script>
        var swiper = new Swiper('.swiper-container', {
            pagination: {el: '.swiper-pagination',},
        });
  	</script>
</body>
</html>
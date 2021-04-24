<!DOCTYPE html>

<head>
    <title>Recherche</title>
    <?php include('layout/Header.php')?>
    <?php include ('../APIs/include/dbConnection.php');
    	  session_start();
    	  $_SESSION['commande']=array();
    ?>

    <link rel="stylesheet" href="css/recherche.css"/>
</head>

<body>
	<?php include('layout/Menu.php'); ?>

	<div class="banner">
        <h2>Recherche</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="10vw" viewBox="0 0 1280 140" preserveAspectRatio="none">
            <g fill="#ffffff">
                <path d="M1280 3.4C1050.59 18 1019.4 84.89 734.42 84.89c-320 0-320-84.3-640-84.3C59.4.59 28.2 1.6 0 3.4V140h1280z" fill-opacity=".3"/>
                <path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V140H0z" fill-opacity=".5"/>
                <path d="M1280 51.76c-201 12.49-242.43 53.4-513.58 53.4-320 0-320-57-640-57-48.85.01-90.21 1.35-126.42 3.6V140h1280z"/>
            </g>
        </svg>
    </div>

	<!-- <section class='infos-pers'>
		<div class='container'>
			<div class='infos-titre'>
				<h4>Vos Informations Personnelles</h4>
			</div>
			<div class='infos-content'>
				<div>
                    <span><i>Nom</i></span>
					<span>Ramos</span>
				</div>
				<div>
                    <span><i>Prénom</i></span>
					<span>Juan</span>
				</div>
				<div>
                    <span><i>Adresse Mail</i></span>
					<span>juansebastian60@yahoo.es</span>
				</div>
				<div>
                    <span><i>Date de naissance</i></span>
					<span>11/02/1999</span>
				</div>
			</div>
		</div>
	</section>

	<section class='recherche'>
		<form method="get" >
			<input type="search" name="q" placeholder="Recherche..." />
			<input type="submit" value="Valider" />
		</form>
	</section>

	<section class='form-order'>
		<div class="container">
			<form method="post" class='commandes'>
                <?php
                    $articles = $conn->query('SELECT book_name FROM books');
                    if(isset($_GET['q']) AND !empty($_GET['q'])) {
                        $q = htmlspecialchars($_GET['q']);
                        $articles = $conn->query('SELECT book_name FROM books WHERE book_name LIKE "%'.$q.'%"');
                    }
                ?>
                <select name='search'>
                    <option>Résultat de votre recherche</option>
                    <?php
                        while($show=mysqli_fetch_array($articles)){
                            echo "<option>".$show['book_name']."</option><br/>";
                        }
                    ?>
                </select>
                <select name='livre' id='livre'>
                    <option>Selectionner un livre</option>
                    <?php
                        $sql="SELECT book_name FROM books";
                        $result= mysqli_query($conn,$sql);
                        while($show=mysqli_fetch_array($result)){
                            echo "<option>".$show['book_name']."</option><br/>";
                        }
                    ?>
                </select>

                <select name='prod'>
                    <option>Selectionner un produit</option>
                    <?php
                        $sql2="SELECT product_name FROM products";
                        $result2= mysqli_query($conn,$sql2);
                        while($show2=mysqli_fetch_array($result2)){
                            echo "<option>".$show['product_name']."</option><br/>";
                        }
                    ?>
                </select>
                <input type="submit" name='submit' class="btn btn-success" />
            </form>
        </div>
	</section>

	<section class='prod-sel'>
		<?php

			if (isset($_POST['submit'])){
				if($_POST['search']!='Résultat de votre recherche'){
					array_push($_SESSION['commande'], $_POST['search']);
					if($_POST['livre']!='Selectionner un livre'){
						array_push($_SESSION['commande'], $_POST['livre']);
						echo $_SESSION['commande'];
					};
					if($_POST['prod']!='Selectionner un produit'){
						array_push($_SESSION['commande'], $_POST['prod']);
						echo $_SESSION['commande'];
					}
				}
				else{
					if($_POST['livre']!='Selectionner un livre'){
						array_push($_SESSION['commande'], $_POST['livre']);
						echo $_SESSION['commande'];
					};
					if($_POST['prod']!='Selectionner un produit'){
						array_push($_SESSION['commande'], $_POST['prod']);
						echo $_SESSION['commande'];
					}
				}
			}

		?>
		<div class='container'>
			<div class='infos-titre'>
				<h4>Votre Commande</h4>
			</div>
			<div class='prod-sel-content'>
				<div>
                    <span><i>Nom du produit</i></span>
					<span>
                        <?php
                        foreach ($_SESSION['commande'] as $select) {
							echo $select."<br/>";
						}?>
					</span>
				</div>
				<div>
                    <span><i>Prix</i></span>
					<span>
                        <?php print_r($_SESSION['commande']);
									foreach ($_SESSION['commande'] as $select) {
									$result3=$conn->prepare('SELECT price FROM books WHERE books.book_name=? ');
									$result3-> bind_param("s",$select);
									$result3->execute();
									$result3=$result3->get_result();
									while($show3=mysqli_fetch_array($result3)){
										echo $show3['price']."<br/>";
									}
								}
						?>
					</span>
				</div>
				<div>
                    <span><i>Quantité</i></span>
					<span>0</span>
				</div>
			</div>
		</div>
	</section> -->

    <section>
        <div class="container">
        <form method="POST" >
            <label>Movie name: <input type="text" name="name" /></label><br />
            <label>Price: <input type="text" name="price" /></label><br />
            <input type="submit" value="Send" />
        </form>
        </div>
    </section>

	<?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>

    <?php
        if (!isset($_SESSION['name'])) {
            $_SESSION['name'] = array();
            echo "set array";
        }
        if (!isset($_SESSION['price'])) {
            $_SESSION['price'] = array();
        }

        if(isset($_POST['name']) && isset($_POST['price'])) {
            array_push($_SESSION['name'], $_POST['name']);
            array_push($_SESSION['price'], $_POST['price']);

            print_r($_SESSION['name']);
            echo "<br>";
            print_r($_SESSION['price']);
        }
    ?>
</body>
</html>
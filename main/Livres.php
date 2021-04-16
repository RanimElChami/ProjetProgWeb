<!DOCTYPE html>
<html>

<head>
    <title>Livres</title>
    <?php include('layout/Header.php');?>
    <?php include ('../APIs/include/dbConnection.php'); ?>
    <link rel="stylesheet" href="css/livres.css"/>
</head>


<body>
    <?php  include('layout/Menu.php'); ?>



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
                    <?php echo "<img src='{$show["image_dir"]}' alt='Cien anos soledad' >" ?>
                </div>
                <div class="product-details">
                    <h5><?php echo  $show['book_name']?></h5>
                    <p><?php echo  $show['autor']?></p>
                    <p><?php echo  $show['pub_date']?></p>
                    <p>Ref. 00<?php echo  $show['book_id']?> <b> <?php echo  $show['price']?> &euro;</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <?php 
            	}
            ?>
        	
            <!--
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/the_alchemist_.png' alt='The Alchemist' />
                </div>
                <div class="product-details">
                    <h5>The Alchemist</h5>
                    <p>Paulo Cohelo</p>
                    <p>Ref. 002<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/le_parfum.png' alt='Le Parfum' />
                </div>
                <div class="product-details">
                    <h5>Le Parfum</h5>
                    <p>Patrick Süskind</p>
                    <p>Ref. 003<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/things-fall-apart.jpg' alt='Things Fall Apart' />
                </div>
                <div class="product-details">
                    <h5>Things Fall Apart</h5>
                    <p>Chinua Achebe</p>
                    <p>Ref. 004<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/half-of-a-yellow-sun.png' alt='Half Of A Yellow Sun' />
                </div>
                <div class="product-details">
                    <h5>Half Of A Yellow Sun</h5>
                    <p>Chimamanda Ngozi Adichie</p>
                    <p>Ref. 005<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/el-sindrome-de-ulises.png' alt='El Síndrome de Ulises' />
                </div>
                <div class="product-details">
                    <h5>El Síndrome de Ulises</h5>
                    <p>Santiago Gamboa</p>
                    <p>Ref. 006<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/Extension-du-domaine.jpg' alt='Extension du domaine de la lutte' />
                </div>
                <div class="product-details">
                    <h5>Extension Du Domaine De La Lutte</h5>
                    <p>Michel Houellebecq</p>
                    <p>Ref. 007<b> 150€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/memoirs-of-a-geisha.png' alt='Memoirs Of A Geisha' />
                </div>
                <div class="product-details">
                    <h5>Memoirs Of A Geisha</h5>
                    <p>Arthur Golden</p>
                    <p>Ref. 008<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/sherlock-holmes.png' alt='A Study In Scarlet' />
                </div>
                <div class="product-details">
                    <h5>A Study In Scarlet</h5>
                    <p>Sir Arthur Conan Doyle</p>
                    <p>Ref. 009<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/bel-ami.png' alt='Bel Ami' />
                </div>
                <div class="product-details">
                    <h5>Bel Ami</h5>
                    <p>Guy de Maupassant</p>
                    <p>Ref. 010<b> 150€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/madame-bovary.png' alt='Madame Bovary' />
                </div>
                <div class="product-details">
                    <h5>Madame Bovary</h5>
                    <p>Gustave Flaubert</p>
                    <p>Ref. 011<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/pride-and-prejudice.jpg' alt='Pride And Prejudice' />
                </div>
                <div class="product-details">
                    <h5>Pride And Prejudice</h5>
                    <p>Jane Austen</p>
                    <p>Ref. 012<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/ulysses.png' alt='Ulysses' />
                </div>
                <div class="product-details">
                    <h5>Ulysses</h5>
                    <p>James Joyce</p>
                    <p>Ref. 013<b> 150€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/el-olvido-que-seremos.jpg' alt='El Olvido Que Seremos' />
                </div>
                <div class="product-details">
                    <h5>El Olvido Que Seremos</h5>
                    <p>Héctor Abad Faciolince</p>
                    <p>Ref. 014<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>
            <div class="product-div">
                <div class="product-image">
                    <img src='./images/les-miserables.jpg' alt='Les Misérables' />
                </div>
                <div class="product-details">
                    <h5>Les Misérables</h5>
                    <p>Victor Hugo</p>
                    <p>Ref. 015<b> 15€</b></p>
                    <a href="#" target="_blank" class="btn btn-danger">Plus de Détails</a>
                    <a href="#" class="btn btn-success">+ Ajouter au panier</a>
                </div>
            </div>-->
        </div>
            
    </section>



    <?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>
</body>
</html>


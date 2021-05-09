<!DOCTYPE html>

<head>
    <title>Recapitulatif</title>
    <?php include('layout/Header.php')?>
    <?php include ('../APIs/include/dbConnection.php');
    session_start();

    $total=$_SESSION['total'];
    function location($where){
		echo '<script>window.location.href="'.$where.'"</script>';
		
	};
    ?>
    <link rel="stylesheet" href="css/recap.css"/>
</head>

<body>
	<?php include('layout/Menu.php'); ?>

	<div class="banner">
        <h2>Recapitulatif de votre commande</h2>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="10vw" viewBox="0 0 1280 140" preserveAspectRatio="none">
            <g fill="#ffffff">
                <path d="M1280 3.4C1050.59 18 1019.4 84.89 734.42 84.89c-320 0-320-84.3-640-84.3C59.4.59 28.2 1.6 0 3.4V140h1280z" fill-opacity=".3"/>
                <path d="M0 24.31c43.46-5.69 94.56-9.25 158.42-9.25 320 0 320 89.24 640 89.24 256.13 0 307.28-57.16 481.58-80V140H0z" fill-opacity=".5"/>
                <path d="M1280 51.76c-201 12.49-242.43 53.4-513.58 53.4-320 0-320-57-640-57-48.85.01-90.21 1.35-126.42 3.6V140h1280z"/>
            </g>
        </svg>
    </div>
    <section>
    	<div class="container">
    		<div class='prod-sel-content'>
					<div><span style='margin-bottom: 25px;'><i>Nom du produit</i></span>
						<span><?php foreach ($_SESSION['commande'] as $select) { 
										echo $select."<br/>";
									}?>
							</span>
					</div>
					<div><span style='margin-bottom: 25px;'><i>Prix</i></span>
						<span><?php foreach ($_SESSION['commande'] as $select) {
									$sql3='SELECT books.price FROM books WHERE books.book_name="'.$select.'" UNION SELECT products.price FROM products WHERE products.product_name="'.$select.'" ';
									$result3=mysqli_query($conn, $sql3);
									while($show3=mysqli_fetch_array($result3)){
										echo $show3['price']."<br/>";
									}
								}							
						?>
						</span>
					</div>
					<div><span style='margin-bottom: 25px;'><i>Quantité</i></span>
						<?php foreach ($_SESSION['qte'] as $quant){ ?><span> <?php echo $quant;?></span><?php };  ?>
					</div>
				</div>
				<div class="s-total">
					<h4>TOTAL</h4>
					<p>Total sans remise.....<?php echo $total; ?></p>
					<?php 
					if(isset($_SESSION['ancien'])){
						if($_SESSION['ancien']==true){
							if($_SESSION['user_type_id']==1){ 
								$total=($total)-($total*0.15); ?>
								<p>Total avec remise (-15%).....<?php echo $total ; ?></p>
					<?php 	}
							else{
								$total=($total)-($total*0.1); ?>
								<p>Total avec remise (-10%).....<?php echo $total ?></p>
					<?php }}}; ?>
				</div>
				<form class="conf-order" method='post'>
				<div><input type="submit" name='confirmer' class="btn btn-success" value="Confirmer votre panier"></div>
				<div><input type="submit" name='modifier' class="btn btn-success" value="Modifier votre panier" style="background-color: red;border-color: red;" ></div>
			</form>
			<?php if(isset($_POST['confirmer'])){
						$_SESSION['total']=$total;
						if (!(isset($_SESSION['ancien']))){
							$sql4="INSERT INTO user (client_id, first_name, last_name, civility_id, dob, mail, password, pseudo, user_type_id, nb_orders) VALUES (NULL, '".$_SESSION["first_name"]."', '".$_SESSION["last_name"]."', '".$_SESSION["civility_id"]."', '".$_SESSION["dob"]."', '".$_SESSION["mail"]."', '".$_SESSION["password"]."', '".$_SESSION["pseudo"]."', '".$_SESSION["user_type_id"]."', 1) ";
							mysqli_query($conn,$sql4);
							$sql='SELECT user_type_id, nb_orders, client_id FROM user WHERE mail="'.$_SESSION['mail'].'"';
								$result=mysqli_query($conn, $sql);
								while($show=mysqli_fetch_array($result)){
										$_SESSION['user_type_id']=$show['user_type_id'];
										$_SESSION['user_id']=$show['client_id'];
										$_SESSION['nb_orders']=$show['nb_orders'];	
								};
						};
					$sql5="INSERT INTO orders (order_id, user_id, order_date, total_amount) VALUES (NULL, '".$_SESSION["user_id"]."', '".date("Y-m-d")."', '".$_SESSION["total"]."');";
					mysqli_query($conn,$sql5);
					foreach($_SESSION['commande'] as $select){
						$sql6="SELECT book_id, prodorbook FROM books WHERE book_name='".$select."' UNION SELECT product_id, prodorbook FROM products WHERE product_name='".$select."' ";
						$result6=mysqli_query($conn, $sql6);
						while($show6=mysqli_fetch_array($result6)){
							$prodorbook=$show6['prodorbook'];
							$id_prod=$show6['book_id'];
							$quant_prod=$_SESSION['qte'][array_search($select, $_SESSION['commande'])];
					};
					$sql7="SELECT order_id FROM orders WHERE user_id='".$_SESSION["client_id"]."' AND order_date='".date("Y-m-d")."' ";
					$result7=mysqli_query($conn, $sql7);
					while($show7=mysqli_fetch_array($result7)){
							$order_id=$show7['order_id'];
					}
					if($prodorbook==0){
						$sql8="INSERT INTO order_book (order_id, book_id, quantity) VALUES ('".$order_id."', $id_prod, $quant_prod )";
						mysqli_query($conn,$sql8);
					}
					if($prodorbook==1){
						$sql8="INSERT INTO order_product (order_id, product_id, quantity) VALUES ('".$order_id."', $id_prod, $quant_prod )";
						mysqli_query($conn,$sql8);
					}
					
			}
			session_destroy();
			location("Home.php");
		}
		if(isset($_POST['modifier'])){
			session_destroy();
			location('Recherche.php');
			unset($_POST['modifier']);
		}

			?>
			</div>
		</section>



  	<?php include('layout/Footer.php'); ?>

    <?php include('layout/BodyLinks.php'); ?>
</body>
</html>
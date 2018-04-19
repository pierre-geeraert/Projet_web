					<?php
					require 'database.php';
					require 'panier.class.php';
					$DB = new Database();
					$panier = new panier($DB);
					?>


					<!DOCTYPE html>

					<!--####################################
					Auteur : Groupe 3
					Date : 2018
					Contexte : Projet Web Exia CESI
					#######################################-->

					<html>

					<head>
					<meta charset="utf-8" />
					<link rel="stylesheet" href="css/style.css" />
					<link rel="stylesheet" href="css/main.css" />
					<link rel="stylesheet" href="css/Boutique.css" />
					<script src="https://cdn.jsdelivr.net/npm/vue"></script>
					<meta name="viewport" content="width=device-width, initial-scale=1.0">

					<title>BDE Arras</title>
					</head>

					<header>
					<?php include("header.php"); ?>
					</header>

					<body>


					<div class="checkout">
					<div class="title">
					<div class="wrap">
					<h2 class="titreboutique">Votre Panier</h2>
					</div>
					</div>
					<form method="post" action="panier.php">
					<div class="table">
					<div class="wrap">


				<div class="rowtitle" style="width:100%">
					<span class="name" style="width:25%">Nom du produit</span>
					<span class="price" style="width:25%">Prix</span>
					<span class="quantity"style="width:25%">Quantité</span>
					<span class="action"style="width:20%">Supprimer</span>
				</div>

				<?php
				$ids = array_keys($_SESSION['panier']);  // the array of the Basket Session
				if (empty($ids)) {
					$products = array(); // if the array is empty , it is create 
								} 
				else{
					$DB->query('SELECT * FROM products WHERE product_id IN (' . implode(',', $ids) . ')'); // The resquest in order to get the product tables when we have the id 
					
				}
				
				$products = $DB->fetchAll();
				
				$DB->closeCursor();
				$var=0;
				foreach ($products as $product) :		

				$var++;
				
				// Sotck l'idée du produit et la quantité de ce produit
				
				${'id'.$var}=$product['product_id'];
				${'nb'.$var}=$_SESSION['panier'][$product['product_id']];

				?>
			
				<div id="Productlist">
				<span class="name"style="width:25%"><?= $product['name']; ?></span>
				<span class="price"style="width:25%"><?= number_format($product['price'], 2, ',', ' '); ?> €</span>
				<span class="quantity" style="width:25%"><input type="text" name="panier[quantity][<?= $product['product_id']; ?>]" value=<?= $_SESSION['panier'][$product['product_id']]?>></span>

				<span class="action" style="width:20%">
				<a href="panier.php?delPanier=<?= $product['product_id']; ?>" class="del"><img src="Images/del.png" height="50"></a>
				</span>
				</div>
				<?php endforeach; ?>

				<div class="rowtotal">
				<span class="total"><?= number_format($panier->total()); ?> € </span>
				</div>
						<input type="submit" value="Recalculer">
				

				</form>
				<ul>
				<form method="post" action="buy.php">
				<?php 
				for($compteur=1; $compteur<=$var; $compteur++){

				echo '
				<input name="'.'id'.$compteur.'" type="hidden" value="'.${'id'.$compteur}.'"/>
				<input name="'.'nb'.$compteur.'" type="hidden" value="'.${'nb'.$compteur}.'"/>
				';
				}	
				?>
				<input name="var" type="hidden" value=<?= $var?> />
				<input type="submit" name="submit" value="Acheter" />
				</form>
				</ul>
				</div>


				<footer>
				<?php include("footer.php"); ?>
				</footer>  
				</body>


				</html>
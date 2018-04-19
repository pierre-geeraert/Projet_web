<?php   
	session_start(); // Create a session or restore the one found on the server
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi'); // Login to the database
	
	// get the number of products

	$nb_product = $_POST['var'];
	$user_id = $_SESSION['id'];

	
	// for each product

	for($nbr=1; $nbr<=$nb_product ; $nbr++){
		
		// get the idea of ​​the product
		
		$id=$_POST['id'.$nbr];
		
		// Insert the product ID and the ID of the user who bought it
		
		$bdd->query('call add_product_cart("'.$id.'","'.$user_id.'")');
	}

	header('Location: Boutique.php');
?>




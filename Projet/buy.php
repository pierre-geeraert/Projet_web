<?php   
	session_start(); // Permet de créer une session ou de restaurer celle trouvée sur le serveur
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi'); // Connexion à la base de donnée
	
	// récupère le nombre de produit

	$nb_product = $_POST['var'];
	$user_id = $_SESSION['id'];

	
	// Pour chaque produit

	for($nbr=1; $nbr<=$nb_product ; $nbr++){
		
		// récupère l'idée du produit
		
		$id=$_POST['id'.$nbr];
		
		// Insérer l'ID du produit et l'ID de l'utilisateur qui l'a acheté
		
		$bdd->query('call add_product_cart("'.$id.'","'.$user_id.'")');
	}

	header('Location: Boutique.php');
?>




<?php
	session_start(); // Permet de créer une session ou de restaurer celle trouvée sur le serveur
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi'); // Connexion à la base de donnée

	$title=$_POST['title']; // récupérer le titre et la description de l'idée
	$desc=$_POST['desc'];

	$user_id=null;

	if (isset($_SESSION['id'])) { // Permet de vérifier si une variable de session est créé
		$user_id=$_SESSION['id'];
	}

	$bdd->query('call add_idea("'.$title.'","'.$desc.'","'.$user_id.'")'); // Execute une requète
	header('location: BoiteIdee.php'); // Redirige vers BoiteIdee.php
?>
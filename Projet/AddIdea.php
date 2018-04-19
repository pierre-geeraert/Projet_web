<?php
	session_start(); // Create a session or restore the session found on the server
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi'); // Connexion to the database

	// retrieve the title and description of the idea
	
	$title=$_POST['title']; 
	$desc=$_POST['desc'];

	$user_id=null;

	if (isset($_SESSION['id'])) { // Check if a session variable is created
		$user_id=$_SESSION['id'];
	}

	$bdd->query('call add_idea("'.$title.'","'.$desc.'","'.$user_id.'")'); // Execute a request
	header('location: BoiteIdee.php'); // Redirect to BoiteIdee.php
?>
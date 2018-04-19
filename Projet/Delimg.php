<?php   
	session_start();
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

	// Récupère le nombre d'image

	$nbr= $_POST['nbr_url'];

	// Cherche le bouton qui a été actionné

	for($var=1; $var<=$nbr ; $var++)
	{
		if (isset($_POST[$var]))
		{
			// Supprimer l'image associé au bouton qui a été actionné
			
			$bdd->query('call delete_pic('.$_POST[$var].')');
		}
	}

	// Redirige vers Evenements.php

	header('Location: Evenements.php');
?>
<?php
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

	// Cherche quel bouton a été actionné parmis les 3 

	for($var=1; $var<=3 ; $var++)
	{
		if (isset($_POST[$var]))
		{
			// Supprime le commentaire associé au bouton qui a été actionné
			
			$bdd->query('call delete_comment("'.$_POST[$var].'")');
		}
	}

	// Redirige vers Evenements.php
	
	header('Location: Evenements.php');
?>
<?php   
	session_start();
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

	$nbr = $_POST['nbr_url'];
	$user_id = $_SESSION['id'];


	// Look for the great button

	for($var=1; $var<=$nbr ; $var++){
		if (isset($_POST[$var])) {
			// get the picture ID
			$bdd->query('call notif_insert_nocif("'.$user_id.'","'.$_POST[$var].'")');
		}
	}

	// redirect to Evenements.php

	header('Location: Evenements.php');

?>
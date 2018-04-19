<?php   
	session_start();
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

	// Get the number of images

	$nbr= $_POST['nbr_url'];

	// Look for the button that has been pressed

	for($var=1; $var<=$nbr ; $var++)
	{
		if (isset($_POST[$var]))
		{
			// Delete the image associated with the button that was pressed
			
			$bdd->query('call delete_pic('.$_POST[$var].')');
		}
	}

	// Redirect to Evenements.php

	header('Location: Evenements.php');
?>
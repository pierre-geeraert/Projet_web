<?php
	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

	// Find out which of the three buttons was pressed. 

	for($var=1; $var<=3 ; $var++)
	{
		if (isset($_POST[$var]))
		{
			// Deletes the comment associated with the button that was pressed
			
			$bdd->query('call delete_comment("'.$_POST[$var].'")');
		}
	}

	// Redirect to Evenements.php
	
	header('Location: Evenements.php');
?>
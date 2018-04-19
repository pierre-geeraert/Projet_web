<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
	
$nbr = $_POST['nbr_url'];
$user_id=$_SESSION['id'];


// Look for the great button

for($var=1; $var<=$nbr ; $var++){
	if (isset($_POST[$var])) {
		$event_id=$_POST[$var];
		
		// get the idea ID
		
		$bdd->query('call vote('.$user_id.', '.$event_id.')');
	}
}

header('location: BoiteIdee.php');
?>
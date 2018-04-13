<?php   
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$nbr = $_POST['nbr_event'];
$user_id = $_SESSION['id'];

for($var=1; $var<=$nbr ; $var++){
	if (isset($_POST[$var])) {
		$reponse = $bdd->query('call subscribe_event('.$user_id.', '.$_POST[$var].')');
	}
}

header('location: Evenements.php');

?>
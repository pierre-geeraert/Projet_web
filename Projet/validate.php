<?php   
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$nbr = $_POST['nbr_event'];
$user_id = $_SESSION['id'];
$date= $_POST['date'];

for($var=1; $var<=$nbr ; $var++){
	if (isset($_POST[$var])) {
		$bdd->query('call validation_event('.$_POST[$var].','.$user_id.',"'.$date.'" )');
	}
}

header('Location: BoiteIdee.php');

?>
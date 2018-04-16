<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$comment= $_POST['comment'];
$user_id=$_SESSION['id'];
$nbr = $_POST['nbr_url'];

for($var=1; $var<=$nbr ; $var++){
	if (isset($_POST[$var])) {
		$bdd->query('call comment("'.$comment.'",'.$_POST[$var].','.$user_id.')');
	}
}

header('location: Evenements.php');
?>
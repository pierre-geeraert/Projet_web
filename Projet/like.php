<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
	
$nbr = $_POST['nbr_url'];
$user_id=$_SESSION['id'];


for($var=1; $var<=$nbr ; $var++)
{
	if (isset($_POST[$var]))
	{
		$picture_id=$_POST[$var];
		$bdd->query('call `like`('.$user_id.', '.$picture_id.')');
	}
}

header('location: Evenements.php');
?>
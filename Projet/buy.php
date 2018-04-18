<?php   
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$var = $_POST['var'];
$user_id = $_SESSION['id'];


for($nbr=1; $nbr<=$var ; $nbr++){
	$id=$_POST['id'.$nbr];
	$nb=$_POST['nb'.$nbr];
	$bdd->query('call add_product_cart("'.$id.'","'.$user_id.'")');
}


?>




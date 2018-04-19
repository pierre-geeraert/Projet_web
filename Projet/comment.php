<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

// Récupère le commentaire, ainsi que le nombre total d'url

$comment= $_POST['comment'];
$user_id=$_SESSION['id'];
$nbr = $_POST['nbr_url'];

// Scan tous les boutons, pour savoir lequel a été actionné

for($var=1; $var<=$nbr ; $var++)
{
	if (isset($_POST[$var])) 
	{
		// Insérer le commentaire associer à l'image dans la base de donnée
		
		$bdd->query('call comment("'.$comment.'",'.$_POST[$var].','.$user_id.')');
	}
}

// Redirige vers Evenemens.php

header('location: Evenements.php');
?>
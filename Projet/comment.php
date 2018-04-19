<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

// Get the comment, as well as the total number of urls

$comment= $_POST['comment'];
$user_id=$_SESSION['id'];
$nbr = $_POST['nbr_url'];

// Scan all buttons, to know which one was pressed

for($var=1; $var<=$nbr ; $var++)
{
	if (isset($_POST[$var])) 
	{
		// insert the comment associated to the image in the database
		
		$bdd->query('call comment("'.$comment.'",'.$_POST[$var].','.$user_id.')');
	}
}

// Redirect to Evenemens.php

header('location: Evenements.php');
?>
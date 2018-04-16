<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$title=$_POST['title'];
$desc=$_POST['desc'];
$date=$_POST['date'];

$user_id=null;

if (isset($_SESSION)) { 
	$user_id=$_SESSION['id'];
	echo $_SESSION['id'];
}

echo $title;
echo $desc;
echo $user_id;

$bdd->query('call add_event("'.$title.'","'.$desc.'","'.$user_id.'","'.$date.'")');
header('Location: BoiteIdee.php');
?>
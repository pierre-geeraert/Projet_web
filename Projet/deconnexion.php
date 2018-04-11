<?php   
	session_start(); //to ensure you are using same session
	$_SESSION['login']=null;
	header('location: index.php');
?>
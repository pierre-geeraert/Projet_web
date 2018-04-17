<?php   
	session_start(); //to ensure you are using same session
	$_SESSION['login']=null;
	$_SESSION['name'] = null;
	$_SESSION['surname'] = null;
    $_SESSION['mdp'] = null;
	$_SESSION['statut'] = null;
	$_SESSION['id'] = null;
	header('location: index.php');
?>
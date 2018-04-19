<?php  
	session_start(); 
	
	// Attribuer la valeur null à toutes les variables
	
	$_SESSION['login']=null;
	$_SESSION['name'] = null;
	$_SESSION['surname'] = null;
    $_SESSION['mdp'] = null;
	$_SESSION['statut'] = null;
	$_SESSION['id'] = null;
	header('location: index.php');
?>
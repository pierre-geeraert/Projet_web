<?php 
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$login = $_POST['login'];
$pass = $_POST['motdepasse'];

//  Get the informations about the user 

$req = $bdd->prepare('SELECT name, surname, password, status, user_id FROM users WHERE email = :login');
$req->execute(array(':login' => $login));
$resultat = $req->fetch();


if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe (1) !';
}

else

{
    if ($pass === $resultat['password']) {

        session_start();
		
		// put the informations in the global variable
		
		$_SESSION['name'] = $resultat['name'];
		$_SESSION['surname'] = $resultat['surname'];
        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $pass;
		$_SESSION['statut'] = $resultat['status'];
		$_SESSION['id'] = $resultat['user_id'];
		
		header('location: index.php');

    }

    else {
        echo 'Mauvais identifiant ou mot de passe (2) !';
    }

}
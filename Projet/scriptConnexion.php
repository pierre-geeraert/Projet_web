<?php 

$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$login = $_POST['login'];
$pass = $_POST['motdepasse'];

//  Récupération de l'utilisateur et de son pass hashé

$req = $bdd->prepare('SELECT name, surname, password FROM users WHERE email = :login');
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
		$_SESSION['name'] = $resultat['name'];
		$_SESSION['surname'] = $resultat['surname'];
        $_SESSION['login'] = $login;
        $_SESSION['mdp'] = $pass;
        echo 'Vous êtes connecté !';
		header('location: index.php');

    }

    else {
        echo 'Mauvais identifiant ou mot de passe (2) !';
    }

}
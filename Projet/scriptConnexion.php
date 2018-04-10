<?php 

$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$login = $_POST['login'];
$pass = $_POST['motdepasse'];

//  Récupération de l'utilisateur et de son pass hashé

$req = $bdd->prepare('SELECT idUsers, Mdp FROM utilisateurs WHERE Email = :login');
$req->execute(array(':login' => $login));
$resultat = $req->fetch();


if (!$resultat)
{
    echo 'Mauvais identifiant ou mot de passe (1) !';
}

else

{
    if ($pass === $resultat['Mdp']) {

        session_start();
        $_SESSION['idUsers'] = $resultat['idUsers'];
        $_SESSION['Mdp'] = $login;
        echo 'Vous êtes connecté !';

    }

    else {
        echo 'Mauvais identifiant ou mot de passe (2) !';
    }

}
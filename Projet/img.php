<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$bdd2 = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$event_id_in= $_POST['id'];
$user_id=$_SESSION['id'];

$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );

//1. strrchr renvoie l'extension avec le point (« . »).
//2. substr(chaine,1) ignore le premier caractère de chaine.
//3. strtolower met l'extension en minuscules.

//find extension of pictures
$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );

$num = md5(uniqid(rand(), true));

$nom = "image/photos/{$num}.{$extension_upload}";

try {

        $requete2 = $bdd->prepare("call verification_event(:event_id,:user_id)");
        $requete2->bindValue(':user_id', $user_id, PDO::PARAM_STR);
        $requete2->bindValue(':event_id', $event_id_in, PDO::PARAM_STR);
        $requete2->execute();

} catch (PDOException $e) {
    echo $e;
}

$donnees = $requete2->fetch();
$bool_verif= $donnees['bool_present'];

echo $bool_verif;
if(!$bool_verif){header('location: alert.php');}
if($bool_verif) {

    try {
        $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
        if (!$resultat) {
            throw new Exception('Could not move file');
        }
    } catch (Exception $e) {
        die ('File did not upload: ' . $e->getMessage());
    }


    if ($resultat) {
        try {
            $requete1 = $bdd2->prepare("call add_picture(:url,:user_id,:event_id)");
            $requete1->bindValue(':url', $nom, PDO::PARAM_STR);
            $requete1->bindValue(':user_id', $user_id, PDO::PARAM_STR);
            $requete1->bindValue(':event_id', $event_id_in, PDO::PARAM_STR);
            $requete1->execute();
        } catch (PDOException $e) {
            echo $e;
        }

        header('location: Evenements.php');
    }
}


?>
<?php
session_start();

$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
$bdd2 = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

// we find our title , description date and user_id from post or session var
$title=$_POST['title'];
$desc=$_POST['desc'];
$date=$_POST['date'];
$user_id=$_SESSION['id'];

//Use to upload and move pictures
$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
$num = md5(uniqid(rand(), true));
$nom = "image/photos/{$num}.{$extension_upload}";

try {
    $resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
    if (!$resultat) {
        throw new Exception('Could not move file');
    }
} catch (Exception $e) {
    die ('File did not upload: ' . $e->getMessage());
}





try {
    //$var=$bdd->query('call add_event("'.$title.'","'.$desc.'","'.$user_id.'","'.$date.'")');

    $requete2 = $bdd2->prepare("call add_event(:title,:description,:date_in)");
    $requete2->bindValue(':title', $title, PDO::PARAM_STR);
    $requete2->bindValue(':description', $desc, PDO::PARAM_STR);
    //$requete2->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $requete2->bindValue(':date_in', $date, PDO::PARAM_STR);
    $requete2->execute();

} catch (PDOException $e) {
    echo $e;
}


$donnees = $requete2->fetch();

$event_id_in=$donnees['event_id_out'];

try {

    $requete1 = $bdd->prepare("call add_picture(:url,:user_id,:event_id)");
    $requete1->bindValue(':url', $nom, PDO::PARAM_STR);
    $requete1->bindValue(':user_id', $user_id, PDO::PARAM_STR);
    $requete1->bindValue(':event_id', $event_id_in, PDO::PARAM_STR);
    $requete1->execute();
    } catch (PDOException $e) 
{
    echo $e;
}





header('Location: BoiteIdee.php');

?>


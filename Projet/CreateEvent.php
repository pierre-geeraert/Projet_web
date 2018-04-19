<?php
	session_start();

	// Récupère le titre, le description, et la date du nouvel événement
	
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	$date=$_POST['date'];
	$user_id=$_SESSION['id'];

	// Indique les extensions autorisées
	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
	// récupère l'extension
	$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
	// Générère un numéro aléatoirement, il servira de nom pour l'image
	$num = md5(uniqid(rand(), true));
	// Associement les différents éléments afin de former l'URL de l'image
	$nom = "image/photos/{$num}.{$extension_upload}";

	// Déplacer l'image dans le dossier spécifié
	
	try {
		$resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
		if (!$resultat) {
			throw new Exception('Could not move file');
		}
	} catch (Exception $e) {
		die ('File did not upload: ' . $e->getMessage());
	}

	// Ajoute le nouvel événement dans la base de donnée

	try {
		$requete2 = $bdd->prepare("call add_event(:title,:description,:date_in)");
		$requete2->bindValue(':title', $title, PDO::PARAM_STR);
		$requete2->bindValue(':description', $desc, PDO::PARAM_STR);
		$requete2->bindValue(':date_in', $date, PDO::PARAM_STR);
		$requete2->execute();

	} catch (PDOException $e) {
		echo $e;
	}


	$donnees = $requete2->fetch();
	$event_id_in=$donnees['event_id_out'];
	
	// Ajoute l'URL de l'image dans la base de donnée en l'associant à l'événement

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
	
	// Redirige vers la boite à idée

	header('Location: BoiteIdee.php');
?>


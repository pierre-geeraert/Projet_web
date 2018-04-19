<?php
	session_start();

	// Retrieves the title, description, and date of the new event
	
	$title=$_POST['title'];
	$desc=$_POST['desc'];
	$date=$_POST['date'];
	$user_id=$_SESSION['id'];

	// Indicates allowed extensions
	$extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
	// get the extension
	$extension_upload = strtolower(  substr(  strrchr($_FILES['image']['name'], '.')  ,1)  );
	// Generates a random number, it will serve as the name for the image
	$num = md5(uniqid(rand(), true));
	// Associates the different elements to form the URL of the image
	$nom = "image/photos/{$num}.{$extension_upload}";

	// Move the image to the specified folder
	
	try {
		$resultat = move_uploaded_file($_FILES['image']['tmp_name'], $nom);
		if (!$resultat) {
			throw new Exception('Could not move file');
		}
	} catch (Exception $e) {
		die ('File did not upload: ' . $e->getMessage());
	}

	// Adds the new event to the database

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
	
	// Adds the URL of the image to the database by associating it with the event

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
	
	// Redirect to BoiteIdee.php

	header('Location: BoiteIdee.php');
?>


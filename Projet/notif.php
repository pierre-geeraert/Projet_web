<!--####################################
 Auteur : Groupe 3
 Date : 2018
 Contexte : Projet Web Exia CESI
 #######################################-->

<html>
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" href="css/style.css" />
        <link rel="stylesheet" href="css/BoiteIdee.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>BDE Arras</title>
    </head>
 
    <header>
	
	<?php include("header.php"); ?>

    </header>
	
<body>
	<div class="wrapper">
	
		<?php
		if (!isset($_SESSION)) { session_start(); }
		$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
		
		$reponse = $bdd->query('SELECT user_sent_id, date, picture_id FROM notification');
		$reponse2 = $bdd->query('SELECT url FROM pictures INNER JOIN notification ON notification.picture_id = pictures.picture_id');

		if (isset($_SESSION)) { 
			if($_SESSION['statut'] === "BDE"){ 
			
		$var=0;
		while($donnees = $reponse->fetch()){
			${'user_sent_id'.$var} = $donnees['user_sent_id'];
			${'dates'.$var} = $donnees['date'];
			${'picture_id'.$var} = $donnees['picture_id'];
			
			$reponse2 = $bdd->query('SELECT url FROM pictures WHERE picture_id="'.${'picture_id'.$var}.'"');
			$donnees2=$reponse2->fetch();
			${'picture_url'.$var}=$donnees2['url'];
			$reponse2->closeCursor();
			
			$reponse3 = $bdd->query('SELECT name, surname FROM users WHERE user_id="'.${'user_sent_id'.$var}.'"');
			$donnees3=$reponse3->fetch();
			${'user_name'.$var}=$donnees3['name'];
			${'user_surname'.$var}=$donnees3['surname'];
			$reponse3->closeCursor();
			
			
		echo '
		
			<p>
			L\'utilisateur : '.${'user_name'.$var}.' '.${'user_surname'.$var}.' à signaler l\'image : '.${'picture_url'.$var}.' le '.${'dates'.$var}.' 
			</p>

		
		';
		$var++;
		}
		
			}
		}
		
		
		?>

	</div>
</body>
	
<footer>
	
<?php include("footer.php"); ?>
	
</footer>

</html>
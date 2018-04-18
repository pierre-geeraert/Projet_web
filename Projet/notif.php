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
		$bdd2 = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
		
		$reponse = $bdd->query('SELECT user_sent_id, date, picture_id FROM notification WHERE type="0"');
		$reponse2 = $bdd->query('SELECT url FROM pictures INNER JOIN notification ON notification.picture_id = pictures.picture_id');

		if (isset($_SESSION))
		{ 
			if($_SESSION['statut'] === "BDE")
			{ 
			
				$var=0;
				while($donnees = $reponse->fetch())
				{
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
		
		$reponse4 = $bdd->query('SELECT user_id FROM orders WHERE paid="0"');
		$nbr_user=0;
		while($donnees4 = $reponse4->fetch())
		{
			$nbr_user++;
			${'user_id'.$nbr_user} = $donnees4['user_id'];
			
			
			$reponse5 = $bdd->query('call show_contain_user("'.${'user_id'.$nbr_user}.'")');
			
			$nbr_product=0;
			while($donnees5 = $reponse5->fetch())
			{
				$nbr_product++;
				${'product_name'.$nbr_product} = $donnees5['name'];
								
				
				$reponse7 = $bdd2->query('SELECT name, surname FROM users WHERE user_id="'.${'user_id'.$nbr_user}.'"');
				$donnees7 = $reponse7->fetch();
				${'user_name'.$nbr_user}=$donnees7['name'];
				${'user_surname'.$nbr_user}=$donnees7['surname'];
				$reponse3->closeCursor();
				
				echo '
				<p>
					L\'utilisateur : '.${'user_name'.$nbr_user}.' '.${'user_surname'.$nbr_user}.' à acheter le produit : '.${'product_name'.$nbr_product}.'
				</p>
				';
			
			}
			
			$reponse5->closeCursor();
		
		
		
		
			
			
		}
		
		?>

	</div>
</body>
	
<footer>
	
<?php include("footer.php"); ?>
	
</footer>

</html>
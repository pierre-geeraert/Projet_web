<!DOCTYPE html>

<!--####################################
 Auteur : Groupe 3
 Date : 2018
 Contexte : Projet Web Exia CESI
 #######################################-->

<html style="overflow-x: hidden;">

    <head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="css/style.css" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>BDE Arras</title>
    </head>

    <header>
	<?php include("header.php"); ?>
    </header>
	
	
    <body>
		<div class="wrapper">
		
			
	<?php	
	
		// A member of the BDE team can add an event
	
		if (isset($_SESSION['statut']))
		{ 
			if($_SESSION['statut'] === "BDE")
			{ 
				echo '
				<div class="new_event">
				<fieldset class="inner">
				<a href="AddEvent.php"> Ajouter un évenement </a>
				</fieldset>
				</div>	';
			}
		}	

		// A tutor can download all web site picture
		
		if (isset($_SESSION['statut']))
		{ 
			if($_SESSION['statut'] === "Tuteur")
			{ 
				echo '
				<div class="new_event">
				<fieldset class="inner">
				<a href="dl.php"> Enregistrer les images </a>
				</fieldset>
				</div>	';
			}
		}		
	?>																	


	<div class="even1">

		<h3>Evénements à venir :</h3>

		<?php

		$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
		$bdd2 = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
		// Get the event name, the description, and the event ID

		$reponse = $bdd->query('call event_futur');
		$nbr_event=0;
		while ($donnees = $reponse->fetch())
		{
			$nbr_event++;
			${'event'.$nbr_event}=$donnees['event'];
			${'description'.$nbr_event}=$donnees['description'];
			${'id'.$nbr_event}=$donnees['event_id'];
		}
		
		// Displays as many sections as there are events

		for($var=1; $var <= $nbr_event; $var++)
		{	
			$reponse2 = $bdd2->query('SELECT url FROM pictures WHERE pictures.event_id = '.${'id'.$var}.'');
			while($donnees2 = $reponse2->fetch()){
				$url = $donnees2['url']; 
				$reponse2->closeCursor();
			}
			echo '
			<ul>
			<fieldset>

			<p> > '.${'event'.$var}.' < </p>

			<fieldset class="inner">
			<img src="'.$url.'" width="17%">
			<p class="description"> '.${'description'.$var}.' </p>

			<form id="'.$var. '" action="participate.php" method="post">
			<input type="hidden" name="' .$var.'" value="'.${'id'.$var}.'"/>
			<input type="hidden" name="nbr_event" value="'.$nbr_event.'"/>
			</form> 
			<a class="participate "href=\'#\' onclick=\'document.getElementById("'.$var.'").submit()\'> Je participe </a>
			';
			
			// Displays the button " liste des inscrits " only if the user is a BDE member

			if (isset($_SESSION['statut'])) 
			{ 
				if($_SESSION['statut'] === "BDE")
				{ 
					echo '
					<ul> 
					<form id="'.$var. '" action="dl_user.php" method="post">
					<input type="hidden" name="' .$var.'" value="'.${'id'.$var}.'"/>
					<input type="hidden" name="nbr_event" value="'.$nbr_event.'"/>
					<input type="submit" name="submit" value="liste des inscrits" />
					</form> 
					';
				}	
			}
			echo '      
			</ul>

			</fieldset>

			</fieldset>
			</ul>
			';
		}					
		?>
	</div>

	<div class="even2">

	<h3> Evénements passés :</h3>

	<?php

	$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

	$reponse = $bdd->query('call event_past');
	$nbr_event=0;
	
	// Get the event name, the description, and the event ID
	
	while ($donnees = $reponse->fetch())
	{
		$nbr_event++;
		${'event'.$nbr_event}=$donnees['event'];
		${'description'.$nbr_event}=$donnees['description'];
		${'id'.$nbr_event}=$donnees['event_id'];
	}
	
	// Displays as many sections as there are events
	
	for($var=1; $var <= $nbr_event; $var++)
	{
		$id_form = 'id'.$var;
		echo '
		<ul>
		<fieldset>

		<form id="'.$id_form. '" action="script_event.php" method="post">
		<input type="hidden" name="' .$var.'" value="'.${'id'.$var}.'"/>
		<input type="hidden" name="nbr_event" value="'.$nbr_event.'"/>
		</form> 

		<a class="event "href=\'#\' onclick=\'document.getElementById("'.$id_form.'").submit()\'> '.${'event'.$var}.' </a>

		<fieldset class="inner">

		<p class="description">
		'.${'description'.$var}. '
		</p>
		<ul>    
		<form method="post" action="img.php" enctype="multipart/form-data">
		<input type="file" name="image" />
		<input name="id" type="hidden" value="' .${'id'.$var}.'"/>
		<input type="submit" name="submit" value="Envoyer" />
		</form>
		</ul>

		</fieldset>

		</fieldset>
		</ul>
		';
	}					
	?>

	</div>

	</div>
</body>


<footer>
<?php include("footer.php"); ?>
</footer>

</html>
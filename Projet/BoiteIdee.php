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
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <title>BDE Arras</title>
    </head>
 
    <header>
	
	<?php include("header.php"); ?>

    </header>

<body>

	<div class="wrapper">

<div class="form-style-6">
	<h1>Quel est votre idée</h1>
	form  method="post" action="AddIdea.php">
	<input type="text" name="title" placeholder="Titre de l'idée"/>
	<input type="text" name="desc" placeholder="Description de l'idée"/> 
	<input type="submit" value="Envoyer" />
	</form>
</div>
		
<?php
						
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
				
$reponse = $bdd->query('SELECT event, description, event_id FROM events WHERE validation="0"');
$nbr_event=0;
while ($donnees = $reponse->fetch()){
	$nbr_event++;
	${'event'.$nbr_event}=$donnees['event'];
	${'description'.$nbr_event}=$donnees['description'];
	${'id'.$nbr_event}=$donnees['event_id'];
			       					}
							
for($var=1; $var <= $nbr_event; $var++)
{
	$event_var='event'.$var;	
	$reponse2= $bdd->query('call nb_vote('.${'id'.$var}.')');
	$donnees2=$reponse2->fetch();
	$nbr_vote=$donnees2['nbr_vote'];
	$reponse2->closeCursor();				
				echo '
				<ul class="center_boite">
					<fieldset>
					'.${'event'.$var}.'
						<fieldset class="inner">
															
				<p>
					'.${'description'.$var}.'
				</p>
				<form id="'.$event_var.'" action="vote.php" method="post">
					<input type="hidden" name="'.$var.'" value="'.${'id'.$var}.'"/>
					<input type="hidden" name="nbr_url" value="'.$nbr_event.'"/>
				</form> 
						
				<a href=\'#\' onclick=\'document.getElementById("'.$event_var.'").submit()\'> Voter ('.$nbr_vote.') </a>
				';
	if (isset($_SESSION['statut'])) 
				{ 
				if($_SESSION['statut'] === "BDE"){ 
					echo '
				<form id="'.$var.'" action="validate.php" method="post">
					<input type="hidden" name="'.$var.'" value="'.${'id'.$var}.'"/>
					<input type="hidden" name="nbr_event" value="'.$nbr_event.'"/>
					<input id="date" name="date" required="required" type="text" placeholder="Insérez une date (ex :2018-01-30)" />
				</form> 
				
				<a class="participate "href=\'#\' onclick=\'document.getElementById("'.$var.'").submit()\'> Valider l\'idée </a>
			';
												}
				}
					echo '								
						</fieldset>
						</fieldset>
						</ul>
						';
	}					
		?>

	</div>
</body>
	
<footer>
	
<?php include("footer.php"); ?>
	
</footer>

</html>


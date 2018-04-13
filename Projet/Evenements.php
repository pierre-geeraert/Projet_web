<!DOCTYPE html>

<!--####################################
 Auteur : Groupe 3
 Date : 2018
 Contexte : Projet Web Exia CESI
 #######################################-->

<html>

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
		
				<div class="even1">
				
					<h3>Evénements à venir :</h3>
					
						<?php
						
							$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
							
							$reponse = $bdd->query('call event_futur');
							$nbr_event=0;
							while ($donnees = $reponse->fetch()){
								$nbr_event++;
								${'event'.$nbr_event}=$donnees['event'];
								${'description'.$nbr_event}=$donnees['description'];
								${'id'.$nbr_event}=$donnees['event_id'];
							}
							
							for($var=1; $var <= $nbr_event; $var++){	
									echo '
										<ul>
											<fieldset>
											
												<p> > '.${'event'.$var}.' < </p>
												
												<fieldset class="inner">
												
													<p class="description">
														'.${'description'.$var}.'
														
													</p>
															<form id="'.$var.'" action="participate.php" method="post">
																<input type="hidden" name="'.$var.'" value="'.${'id'.$var}.'"/>
																<input type="hidden" name="nbr_event" value="'.$nbr_event.'"/>
															</form> 
															<a class="participate "href=\'#\' onclick=\'document.getElementById("'.$var.'").submit()\'> Je participe </a>
													
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
							while ($donnees = $reponse->fetch()){
								$nbr_event++;
								${'event'.$nbr_event}=$donnees['event'];
								${'description'.$nbr_event}=$donnees['description'];
								${'id'.$nbr_event}=$donnees['event_id'];
							}
							
							for($var=1; $var <= $nbr_event; $var++){
									echo '
										<ul>
											<fieldset>
											
												<p> > '.${'event'.$var}.' '.${'id'.$var}.' < </p>
												
												<fieldset class="inner">
												
													<p class="description">
														'.${'description'.$var}.'
													</p>
													
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
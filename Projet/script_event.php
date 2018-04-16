
		<html>
			<head>
				<meta charset="utf-8" />
				<link rel="stylesheet" href="css/style.css" />

				<title>BDE Arras</title>
			</head>

			<header>
			
			<?php include("header.php"); ?>

			</header>

<?php   
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');

$nbr = $_POST['nbr_event'];

for($var=1; $var<=$nbr ; $var++){
	if (isset($_POST[$var])) {
		$event_id=$_POST[$var];
	}
}

$reponse = $bdd->query('SELECT url,picture_id FROM pictures WHERE event_id = '.$event_id.'');
$nbr_url=0;
while ($donnees = $reponse->fetch()){
	$nbr_url++;
	${'url'.$nbr_url}=$donnees['url'];
	${'picture'.$nbr_url}=$donnees['picture_id'];
}




for($var=1; $var <= $nbr_url; $var++){
	$picture_var='picture'.$var;
	$reponse2= $bdd->query('call nb_like('.${'picture'.$var}.')');
	$donnees2=$reponse2->fetch();
	$nbr_like=$donnees2['nbr_like'];
	$reponse2->closeCursor();
	
	$reponse3 = $bdd->query('SELECT comments FROM comments WHERE picture_id = '.${'picture'.$var}.'');
	$nbr_comment=0;
	$var2=0;
	
	$comment1=null;
	$comment2=null;
	$comment3=null;
	
	while($donnees3=$reponse3->fetch()){
		$nbr_comment++;
		${'comment'.$nbr_comment}=$donnees3['comments'];
	}
	
	echo '
			
		<body>
			<div class="even1">
				<fieldset class="inner">
					<ul class="img_event">
						<img class="img_event-img" src="'.${'url'.$var}.'" alt="" />
						
						
						<p class="comment">
							'.$comment1.'
							</br>
							'.$comment2.'
							</br>
							'.$comment3.'
						</p>
						
						<form id="'.$picture_var.'" class="test_form" action="like.php" method="post">
							<input type="hidden" name="'.$var.'" value="'.${'picture'.$var}.'"/>
							<input type="hidden" name="nbr_url" value="'.$nbr_url.'"/>
						</form> 
						
						<a href=\'#\' onclick=\'document.getElementById("'.$picture_var.'").submit()\'> Liker la photo ('.$nbr_like.') </a>
						
						
						<form  method="post" action="comment.php">
							<input class="input" id="comment" name="comment" required="required" type="text" placeholder="Insérez votre commentaire ici ..." />
							<input type="hidden" name="'.$var.'" value="'.${'picture'.$var}.'"/>
							<input type="hidden" name="nbr_url" value="'.$nbr_url.'"/>
							<input type="submit" value="Commenter"/>
						</form>';
						
						if (isset($_SESSION)) { 
							if($_SESSION['statut'] === "Tuteur"){ 
								echo '<a href="report.php"> Signaler </a>';
							}
						}
					echo '</ul>
				</fieldset>
			</div>
		</body>
			

	';
	
}



?>

		<footer>	
		<?php include("footer.php"); ?>
		</footer>
		</html>
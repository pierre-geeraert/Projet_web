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
	
	echo '
			
		<body>
			<div class="even1">
				<fieldset class="inner">
					<ul class="img_event">
						<img src="'.${'url'.$var}.'" alt="" width="250px" height="auto" />
						
						<form id="'.$picture_var.'" action="like.php" method="post">
							<input type="hidden" name="'.$var.'" value="'.${'picture'.$var}.'"/>
							<input type="hidden" name="nbr_url" value="'.$nbr_url.'"/>
						</form> 
						
						<a class="participate "href=\'#\' onclick=\'document.getElementById("'.$picture_var.'").submit()\'> Liker la photo ('.$nbr_like.') </a>
						
															
					</ul>
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
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

// get all the event id

for($var=1; $var<=$nbr ; $var++){
	if (isset($_POST[$var])) {
		$event_id=$_POST[$var];
	}
}



$reponse = $bdd->query('SELECT url,picture_id FROM pictures WHERE event_id = '.$event_id.'');
$nbr_url=0;

// get the url and picture id of the event picture

while ($donnees = $reponse->fetch()){
	$nbr_url++;
	${'url'.$nbr_url}=$donnees['url'];
	${'picture'.$nbr_url}=$donnees['picture_id'];
}

// get the number of like for the picture

for($var=1; $var <= $nbr_url; $var++){
	$picture_var='picture'.$var;
	$reponse2= $bdd->query('call nb_like('.${'picture'.$var}.')');
	$donnees2=$reponse2->fetch();
	$nbr_like=$donnees2['nbr_like'];
	$reponse2->closeCursor(); // Closes the cursor, allowing the request to be executed again 
	
	// get the comment and comment_id of the picture
	
	$reponse3 = $bdd->query('SELECT comments,comment_id FROM comments WHERE picture_id = '.${'picture'.$var}.'');
	$nbr_comment=0;
	$var2=0;
	
	// the variable for the 3 last comment
	
	$comment1=null;
	$comment2=null;
	$comment3=null;
	
	// for all picture
	
	while($donnees3=$reponse3->fetch()){
		$nbr_comment++;
		
		// put the comment and comment id in the variable
		
		${'comment'.$nbr_comment}=$donnees3['comments'];
		${'id'.$nbr_comment}=$donnees3['comment_id'];
	}
	
	echo '
			
		<body>
			<div class="wrapper">
			<div class="even1">
				<fieldset class="inner">
					<ul class="img_event">
						<img class="img_event-img" src="'.${'url'.$var}.'" alt="" />';
						
						
					// display the 3 comment
					
					for($var3=1; $var3<=3; $var3++){
						if(isset(${'comment'.$var3})){
							echo'
								<p class="comment">
									'.${'comment'.$var3}.'';
								if (isset($_SESSION)) { 
									if($_SESSION['statut'] === "BDE"){ 
										echo '
										<form  method="post" action="DelComment.php">
											<input type="hidden" name="1" value="'.${'id'.$var3}.'"/>
											<input type="submit" value="Supprimer ce commentaire"/>
										</form>
										</p>
										';
									}
								}
						}
					}	
					
					// display the number of like and the button " liker la photo "
					// display the button " Commenter " 
						
					echo '
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
						
						// Display the button " Signaler le photo " if the user is a " Tuteur "
						
						if (isset($_SESSION)) { 
							if($_SESSION['statut'] === "Tuteur"){ 
								$form_id='a'.$var;
								echo '
								<form id="'.$form_id.'" class="test_form" action="report.php" method="post">
									<input type="hidden" name="'.$var.'" value="'.${'picture'.$var}.'"/>
									<input type="hidden" name="nbr_url" value="'.$nbr_url.'"/>
								</form>
								<a href=\'#\' onclick=\'document.getElementById("'.$form_id.'").submit()\'> Signaler la photo </a>
								';
							}
							
							// Else if the user is a member of BDE , print the button " Supprimer l'image "
							
							elseif ($_SESSION['statut'] === "BDE"){
								echo '
								<form  class="del_img" method="post" action="Delimg.php">
									<input type="hidden" name="'.$var.'" value="'.${'picture'.$var}.'"/>
									<input type="hidden" name="nbr_url" value="'.$nbr_url.'"/>
									<input type="submit" value="Supprimer l\'image"/>
								</form>
								';
							}
						}
						
						
					echo '</ul> 
				</fieldset>
			</div>
			</div>
		</body>
			
	';
}

?>

	<footer>	
		<?php include("footer.php"); ?>
	</footer>
</html>
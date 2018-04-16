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
    <div class="wrapper2">

		<div class="form-style-6">
		<h1>Quel est votre idée</h1>
		<form  method="post" action="AddIdea.php">
			<input type="text" name="title" placeholder="Titre de l'idée"/>
			<input type="text" name="desc" placeholder="Description de l'idée"/> 
			<input type="submit" value="Envoyer" />
		</form>
		</div>


	
    </div>
	</div>
</body>
	
<footer>
	
<?php include("footer.php"); ?>
	
</footer>

</html>


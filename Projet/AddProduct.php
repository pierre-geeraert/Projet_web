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

<?php
echo '	

<body>
	<div class="wrapper">
    <div class="wrapper2">

		<div class="form-style-6">
		<h1>Nouveeau produit</h1>
		<form  method="post" action="CreateProduct.php" enctype="multipart/form-data">
			<input type="text" name="title" placeholder="Nom du produit"/>
			<input type="text" name="desc" placeholder="Description du produit"/> 
			<input type="text" name="prix" placeholder="Prix du produit)"/>
			<input type="file" name="image" />
			
			<input type="submit" value="Envoyer" />
		</form>
		</div>


	
    </div>
	</div>
</body>

';
?>	
<footer>
	
<?php include("footer.php"); ?>
	
</footer>

</html>


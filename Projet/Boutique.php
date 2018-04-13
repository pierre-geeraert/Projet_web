<?php
session_start();
$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
?>


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
        <link rel="stylesheet" href="css/Boutique.css" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
       
        <title>BDE Arras</title>

    </head>

    <!-- L'en-tête -->    
    <header>
	
	<?php include("header.php"); ?>

    </header>
    <body>

 <?php include'BDD.php' ?>
 <?php include'TOP3.php' ?>

  <div class="Meilleurs ventes">
<p id="BESTSELL">Meilleurs ventes :</p>

<?php
// php code that generates the products
?>


        <div class="flex-container">

        
            
    <!-- Article 1-->
    <div class="wrapper3">
    <div class="product-img">
      <img src="">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1> <?php echo $nomTop1 ?></h1>
        <p> <?php echo $DescriTop1 ?> </p>
      
      </div>
      <div class="product-price-btn">
        <p> <?php echo $Price1 ?>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>

    <!-- Article 2-->
        
    < <div class="wrapper3">
    <div class="product-img">
      <img src="">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1>Titre article</h1>
        <p> Description </p>
      
      </div>
      <div class="product-price-btn">
        <p><span>Prix</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>


  
    <!-- Article 3-->
    <div class="wrapper3">
    <div class="product-img">
      <img src="">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1>Titre article</h1>
        <p> Description </p>
      
      </div>
      <div class="product-price-btn">
        <p><span>Prix</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>

</div>
<<<<<<< HEAD
=======

>>>>>>> 5c820e36c690843b6ffa7a92e1cf47f43dc0cdfc

<div id="Produits en vente">


<p id="BESTSELL">Produits en vente :</p>

<?php>
  $bdd ->prepare("SELECT * FROM `products`");
  $bdd ->execute();
  ($result=$bdd->fetch())
  
  
  
  
  
  
?>
<div class="flex-container">

  <!--Article 1 -->
 <div class="wrapper3">
    <div class="product-img">
      <img src="">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1>Titre article</h1>
        <p> Description </p>
      
      </div>
      <div class="product-price-btn">
        <p><span>Prix</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>

<<<<<<< HEAD
=======
 <!--Article 2 -->

<div class="wrapper3">
    <div class="product-img">
      <img src="">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1>Titre article</h1>
        <p> Description </p>
      
      </div>
      <div class="product-price-btn">
        <p><span>Prix</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>

<!--Artcile 3 -->


<div class="wrapper3">
    <div class="product-img">
      <img src="">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1>Titre article</h1>
        <p> Description </p>
      
      </div>
      <div class="product-price-btn">
        <p><span>Prix</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>

>>>>>>> 5c820e36c690843b6ffa7a92e1cf47f43dc0cdfc
</div>
</div>

<<<<<<< HEAD
=======










	

>>>>>>> 5c820e36c690843b6ffa7a92e1cf47f43dc0cdfc
</body>
<footer>
<?php include("footer.php"); ?>
</footer>
<<<<<<< HEAD
=======

>>>>>>> 5c820e36c690843b6ffa7a92e1cf47f43dc0cdfc
</html>
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

        <title>BDE Arras</title>
    </head>

    <!-- L'en-tête -->    
    <header>
	
	<?php include("header.php"); ?>

    </header>
    <body>

<p id="BESTSELL">Meilleurs ventes :</p>

        <div class="flex-container">

        
            
    <!-- Article 1-->
    <div class="wrapper3">
    <div class="product-img">
      <img src="http://bit.ly/2tMBBTd">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1>Tapis</h1>
        
        <p>Harvest Vases are a reinterpretation<br> of peeled fruits and vegetables as<br> functional objects. The surfaces<br> appear to be sliced and pulled aside,<br> allowing room for growth. </p>
      </div>
      <div class="product-price-btn">
        <p><span>78</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>

    <!-- Article 2-->
        
    <div class="wrapper3">
    <div class="product-img">
      <img src="http://bit.ly/2tMBBTd">
    </div>
    <div class="product-info">
      <div class="product-text">
        <h1>Tapis</h1>
        
        <p>Harvest Vases are a reinterpretation<br> of peeled fruits and vegetables as<br> functional objects. The surfaces<br> appear to be sliced and pulled aside,<br> allowing room for growth. </p>
      </div>
      <div class="product-price-btn">
        <p><span>78</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>

  
    <!-- Article 3-->
  <div class="wrapper3">
    <div class="product-img" style="background-image: url(https://image.darty.com/accessoires/autre_accessoire_informatique/tapis_souris/steelseries_tapis_steelseries_qck_s1509041155261A_155109751.png)"></div>
    <div class="product-info">
      <div class="product-text">
        <h1>Tapis</h1>
        
        <p>Harvest Vases are a reinterpretation<br> of peeled fruits and vegetables as<br> functional objects. The surfaces<br> appear to be sliced and pulled aside,<br> allowing room for growth. </p>
      </div>
      <div class="product-price-btn">
        <p><span>78</span>$</p>
        <button type="button">buy now</button>
      </div>
    </div>
  </div>
</div>
</body>
<footer>
<?php include("footer.php"); ?>
</footer>
</html>
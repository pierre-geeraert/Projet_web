<?php
  require 'database.php';
  require 'panier.class.php';
  $DB = new Database();
  $panier = new panier($DB);
?>

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
      <link rel="stylesheet" href="css/Boutique.css" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <script src="https://cdn.jsdelivr.net/npm/vue"></script>
      <title>BDE Arras</title>
  </head>


  <style> 
    #wrapper {
      padding : 2em
    }

    .wrapper3 {
      width: 27%;
      padding: 2em; 
      margin: 2em 1%;
    }

    .form-group {
      width: 20%;
      margin: 2em 1%;
    }

    .form-group input {
      width: 100%;
      padding: 0.5em 1em;
    }

    .form-group label{
      display: block;
      padding: 1em 0;
      font-weight : bold;
    }

    @media (max-width: 1300px) { 
        .wrapper3 {
            width: 40%;
        }
    }

    @media (max-width: 1000px) { 
        .wrapper3 {
            width: 95%;
        }

        .form-group {
          width: 100%;
        }
    }
  </style>

  <body >
    <header>
        <?php include("header.php"); ?>  
    </header>
	  <div id="wrapper">
	
      <?php	
        if (isset($_SESSION['statut'])) { 
          if($_SESSION['statut'] === "BDE"){ 
            echo '
            <div class="new_event">
              <fieldset class="inner">
              <a href="AddProduct.php"> Ajouter article </a>
              </fieldset>
            </div>	';
          }
        }			
      ?>
	  <?php
	  
		// Request for the auto-completion
	  
		$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
		$requete = $bdd->query('SELECT * FROM products');
		
		// Have the maximum number of names 
		// Save each name in a variable
		
		$nb_max_name=0;
		while($donnees = $requete->fetch()){
			$nb_max_name++;
			${'product_name'.$nb_max_name} = $donnees['name'];
		}
	  ?>
        <section>
            <div class="shop_products">
                <p class="titreboutique">Liste des produits en vente :</p>
				
				<!-- " list_product to create the auto-completion list -->

                <div class="form-group">
                  <label for="terme"> Mot clé de la recherche</label>
                  <input list="list_product" type="text" name="terme" v-model="searchName" v-on:change="getProducts()">
				  
				  <!-- the list of the name product-->
				  
				  <datalist id="list_product">
						<?php
							for($var2=1; $var2<=$nb_max_name; $var2++){
								echo '
									<option value="'.${'product_name'.$var2}.'">
								';
							}
						?>
					</datalist>
                </div>
                
                <div class="flex-container">
                  <div class="wrapper3" v-for="t in prod">  <!-- rendering a list of elements based on a table, t is an element of the table prod -->
                    
                    <div class="product-img">
                      <img :src="`${t.url}`">
                    </div>

                    <div class="product-info">
                      
                      <div class="product-text">
                        <h1> {{t.name}} </h1>   <!-- the element name , work like a for each and will display -->
                        <p>  {{t.description}} </p>  <!-- the element desciption , work like a for each and will display -->
                      </div>

                      <div class="product-price-btn">
                        <p> {{t.price}} €</p>  <!-- the element price , work like a for each and will display -->
						

								<a  :href="`AddPanier.php?id=${t.product_id}`"><button type="button" >Acheter</button></a>

						
                        <a v-on:click="deleteP(t.product_id)"><button type="button" >Supprimer</button></a>  <!-- Will execute the function in deleteP on click -->
                      </div>

                    </div>

                  </div>
                </div>
              </div>
        </section>

        <section>
          <div class="best_sell">
            <p class="titreboutique">Meilleures ventes :</p>
            
        <script>

    </script>     


      
</div>
      
 <div class="shop_products">
            
            

      

            <div class="flex-container" id="best">
              <div class="wrapper3" v-for="b in best">

                <div class="product-img">
                  <img :src="`${b.url}`">
                </div>

                <div class="product-info">
                  <div class="product-text">
                    <h1> {{b.name}} </h1>
                    <p>  {{b.description}} </p>
                  </div>

                  <div class="product-price-btn">
                    <p> {{b.price}} €</p>
                    <a  :href="`AddPanier.php?id=${b.product_id}`" ><button type="button" >Acheter</button></a>
                  </div>
                </div>  

              </div>
            </div>
          </div> 
        </section>
    </div>

    <script>
      let t = new Vue({ // Instantiate a new vue
          el: '#wrapper',
          data: { // Data object with table 
              prod: [], 
              best: [],
              searchName : '' // for the nav bar
          },

          created: function () {
            this.getProducts();
            this.getBest();
          },

          methods : {
            deleteP( productID ) {
              if(confirm("Supprimer le produit ?")) {
                var url = 'Delproduct.php?id=' + productID;  // Will execute a delete function
                fetch(url, { method: 'GET' } )
                  .then((data) => {
                    this.prod = data;
                    this.getProducts()
                  })
                  .catch((err)=>console.error(err))
              }
            },

            getProducts() {
              let search = new FormData();
              search.append( "search", this.searchName );

              fetch('sell_products.php', { method: 'POST', body: search }) // the class who have the request for display product 
                .then((res) => res.json())
                .then((data) =>  this.prod = data)
                .catch((err)=>console.error(err))
            },

            getBest() {
              fetch('BestSell.php', { method: 'GET' }) // the class who have the request for display product 
                .then((res) => res.json())
                .then((data) =>  this.best = data)
                .catch((err)=>console.error(err))
            }
          }     
      })
    </script>   
   
    <footer>
	      <?php include("footer.php"); ?>
    </footer>  
  </body>
</html>
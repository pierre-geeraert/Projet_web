<?php
require 'database.php';
require 'panier.class.php';
$DB = new Database();
$panier = new panier($DB);
?>

<html>
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
        <section>
            <div class="shop_products">
                <p class="titreboutique">Liste des produits en vente :</p>

                <div class="form-group">
                  <label for="terme"> Mot clé de la recherche</label>
                  <input type="text" name="terme" v-model="searchName" v-on:change="getProducts()">
                </div>
                
                <div class="flex-container">
                  <div class="wrapper3" v-for="t in prod">
                    
                    <div class="product-img">
                      <img :src="`Images/Produits/${t.url}`">
                    </div>

                    <div class="product-info">
                      
                      <div class="product-text">
                        <h1> {{t.name}} </h1>
                        <p>  {{t.description}} </p>
                      </div>

                      <div class="product-price-btn">
                        <p> {{t.price}} €</p>
                        <a  :href="`AddPanier.php?id=${t.product_id}`"><button type="button" >Acheter</button></a>
                        <a v-on:click="deleteP(t.product_id)"><button type="button" >Supprimer</button></a>
                      </div>

                    </div>

                  </div>
                </div>
              </div>
        </section>

        <section>
          <div class="best_sell">
            <p class="titreboutique">Meilleures ventes :</p>
            
            <div class="flex-container" id="best">
              <div class="wrapper3" v-for="(b, index) in best">
                <div class="product-img">
                  <img :src="`Images/Produits/${b.url}`">
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
      let t = new Vue({
          el: '#wrapper',
          data: {
              prod: [],
              best: [],
              searchName : ''
          },

          created: function () {
            this.getProducts();
            this.getBest();
          },

          methods : {
            deleteP( productID ) {
              if(confirm("Supprimer le produit ?")) {
                var url = 'Delproduct.php?id=' + productID;
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

              fetch('sell_products.php', { method: 'POST', body: search })
                .then((res) => res.json())
                .then((data) =>  this.prod = data)
                .catch((err)=>console.error(err))
            },

            getBest() {
              fetch('BestSell.php', { method: 'GET' })
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
</html
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
  <body>

    <header>
      <?php include("header.php"); ?>  
    </header>

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
      <script>
        b = new Vue({
          el: '#best',
          data: {
            best: [],
          },
          created: function () {
            fetch('BestSell.php', {
              method: 'GET',
            }).then((res) => res.json())
            .then((data) =>  this.best = data)
            .catch((err)=>console.error(err))
          } 
        })
      </script>
</section>



<section>
      
</div>
      
 <div class="shop_products">
            <p class="titreboutique">Liste des produits en vente :</p>
            

            <div class="flex-container" id="prod">
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
            
            <script>
      let t = new Vue({
          el: '#prod',
          data: {
              prod: [],
          },
          created: function () {
            this.getProducts()
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
              
              fetch('sell_products.php', { method: 'GET' })
                .then((res) => res.json())
                .then((data) =>  this.prod = data)
                .catch((err)=>console.error(err))
            }
          }
             
     
      })
    </script>     


      
</div>
      
    </section>

    <section>
   
    <div id="app">
    
    <div v-for="item in filteredItems" >
      <p>{{item.name}}<p>
    </div>
    
    <input type="text" v-model="search">
    
  </div>  
  <script>

    const app = new Vue({
  
  el: '#app',
  
  data: {
     search: '',
     items: []
       
  },
  created: function () {
            this.getProducts()
          },
          computed: {
    filteredItems() {
      return this.items.filter(item => {
         return item.type.indexOf(this.search.toLowerCase()) > -1
      })
    }
  },
  getProducts() {
              
              fetch('sell_products.php', { method: 'GET' })
                .then((res) => res.json())
                .then((data) =>  this.item = data)
                .catch((err)=>console.error(err))
            },
  
})
    </script>
    
</section>
     

    
 
    <footer>
	<?php include("footer.php"); ?>
    </footer>  
   
  </body>
</html
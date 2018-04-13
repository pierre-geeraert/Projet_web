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

        <div class="best_sell">
            <p id="BESTSELL">Meilleures ventes :</p>

            <div class="flex-container" id="best">
              <div class="wrapper3" v-for="t in best">
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
                    <button type="button">Acheter</button>
                  </div>

                </div>
              </div>
              
              
              <script>
           var b = new Vue({
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

      </div>


      <div class="shop_products">
            <p id="BESTSELL">Liste des produits en vente :</p>

            <div class="flex-container" id="prod">
              <div class="wrapper3" v-for="p in prod">
                <div class="product-img">
                  <img :src="`Images/Produits/${p.url}`">
                </div>

                <div class="product-info">
                  
                  <div class="product-text">
                    <h1> {{p.name}} </h1>
                    <p>  {{p.description}} </p>
                  </div>

                  <div class="product-price-btn">
                    <p> {{p.price}} €</p>
                    <button type="button">Acheter</button>
                  </div>

                </div>
              </div>

            </div>  
            
            
      

      

    
 

    <script>
      var p = new Vue({
          el: '#prod',
          data: {
              prod: [],
          },

          created: function () {
            fetch('sell_products.php', {
              method: 'GET',
            }).then((res) => res.json())
            .then((data) =>  this.prod = data)
            .catch((err)=>console.error(err))
          }
      })
    </script>
  </body>
</html
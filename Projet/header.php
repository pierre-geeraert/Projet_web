<?php
session_start(); // On démarre la session AVANT toute chose
?>

<nav id="header">   
     
<?php
if ($_SESSION['login'] != null)
{
echo'   <div class="element_header">
        <ul>
				<div id="menu">
					<ul>
						  <li><a href="#"> '.$_SESSION['surname'].' '.$_SESSION['name'].' </a>
								<ul>
								  <li><a href="#">Sous-item 1</a></li>
								  <li><a href="#">Sous-item 2</a></li>
								  <li><a href="#">Sous-item 3</a></li>
								</ul>
						  </li>
					</ul>
				</div>
			
			
			<div class="element_header_logout">
				<a href="deconnexion.php"> Deconnexion </a>
			</div>
        </ul>

    </div>'; 
}
else
{
echo'   <div class="element_header">
        <ul>
            <li><a href="connexion.php"> Connexion </a></li>
            <li><a href="inscription.php"> Inscription </a></li>
        </ul>

    </div>'; 
}
?>
    <div class="element_header_photo">
        <ul>
			<img src="image/Cesi.png" width="10%">
			<img src="image/bde.jpg" width="5%">
        </ul>	
    </div> 	

    <div class="element_header2">
        <ul>
            <li><a href="Index.php"> Acceuil </a></li>
            <li><a href="BoiteIdee.php"> Boite à idée </a></li>
            <li><a href="Evenements.php"> Evénements </a></li>
            <li><a href=""> Boutique </a></li>
        </ul>	
    </div> 
	
</nav>


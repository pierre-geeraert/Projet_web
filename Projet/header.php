<?php
if (!isset($_SESSION)) { session_start(); } // Checks if a session is enabled, if not, a session is enabled
?>

<nav id="header">   
     
<?php

// Displays last name, first name, and user status
// Creating a message menu
// IF the user is connected

if (isset($_SESSION['login']))
{
	echo'   
	<div class="element_header">
			<ul>
					<div id="menu">
						<ul>
							  <li><a href="#"> '.$_SESSION['surname'].' '.$_SESSION['name'].' ('.$_SESSION['statut'].') </a>
									<ul>
									  <li><a href="notif.php"> Messagerie </a></li>
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
// Else it displays the login and registration buttons
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
            <li><a href="index.php"> Accueil </a></li>
            <li><a href="BoiteIdee.php"> Boite à idée </a></li>
            <li><a href="Evenements.php"> Evénements du mois </a></li>
			<li><a href="Boutique.php"> Boutique </a></li>
			<a href="panier.php" id="Panier"> <img src="Images/panier.png" height="50" ></a>
		</ul>	
		
					
				
    </div> 
	
</nav>


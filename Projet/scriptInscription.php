<?php
			$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
			$Nom = $_POST['Nom'];
			$Prenom = $_POST['Prenom'];
			$Mdp = $_POST['Mdp'];
			$Email = $_POST['Email'];
			$Statut = $_POST['Statut'];


			$requete1 = $bdd->prepare("SELECT * FROM utilisateurs WHERE Email = :Email");
			$requete1->bindValue(':Email', $Email, PDO::PARAM_STR);
			
			$requete1->execute();
			if ($requete1->fetch()){
				echo("Erreur lors de la création du compte, Email déjà existant");
			}
			else{

					echo("Compte crée avec succès!");

					$requete = $bdd->prepare("INSERT INTO utilisateurs (Nom, Prenom, Mdp, Email, Statut) VALUES(:Nom, :Prenom, :Mdp, :Email, :Statut)");
					$requete->bindValue(':Nom', $Nom, PDO::PARAM_STR);
					$requete->bindValue(':Prenom', $Prenom, PDO::PARAM_STR);
					$requete->bindValue(':Mdp', $Mdp, PDO::PARAM_STR);
					$requete->bindValue(':Email', $Email, PDO::PARAM_STR);
					$requete->bindValue(':Statut', $Statut, PDO::PARAM_STR);
					
					
					$requete->execute();
						
 
			}		
			
				
?>
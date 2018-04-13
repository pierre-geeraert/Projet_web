<?php
			$bdd = new PDO('mysql:host=mysql-pi-ux-ce.alwaysdata.net;dbname=pi-ux-ce_web;charset=utf8', 'pi-ux-ce_web', 'cesi');
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$Nom = $_POST['Nom'];
			$Prenom = $_POST['Prenom'];
			$Mdp = $_POST['Mdp'];
			$Email = $_POST['Email'];
			$Statut = $_POST['Statut'];


			$requete1 = $bdd->prepare("SELECT * FROM users WHERE email = :Email");
			//$requete1 = $bdd->prepare("call test_email(:Email)");

			$requete1->bindValue(':Email', $Email, PDO::PARAM_STR);

			$requete1->execute();
			if ($requete1->fetchAll()){
				echo("<p>Erreur lors de la création du compte, Email déjà existant</p>");
			}
			else {
                    $requete1->fetchAll();
					echo("<p>Compte crée avec succès!</p>");

					//you have to try to flush the buffer;

                    try {
                        $requete = $bdd->prepare("call register(:Nom, :Prenom, :Email2, :Mdp, :Statut)");
                        $requete->bindValue(':Nom', $Nom, PDO::PARAM_STR);
                        $requete->bindValue(':Prenom', $Prenom, PDO::PARAM_STR);
                        $requete->bindValue(':Mdp', $Mdp, PDO::PARAM_STR);
                        $requete->bindValue(':Email2', $Email, PDO::PARAM_STR);
                        $requete->bindValue(':Statut', $Statut, PDO::PARAM_STR);


                        $requete->execute();
                        header('location: connexion.php');
                    }catch(PDOException $e) {
                    	echo($e->getMessage());
                    	}
			}



?>

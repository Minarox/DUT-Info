<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Edit Usager | Cabinet Médical</title>
		<link rel="stylesheet" href="../../assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php" class="active">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php" >Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		<?php
            require('../PHP/db.php');
			$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Civilite = ? AND Nom = ? AND Prenom = ? AND Date_Naissance = ? AND Adresse = ? AND Ville = ? AND Code_Postal = ? AND Lieu_Naissance = ?');
			$requete->execute(array($_POST["Civilite_Usager_N"], $_POST["Nom_Usager_N"], $_POST["Prenom_Usager_N"], $_POST["Date_Naissance_Usager_N"], $_POST["Adresse_Usager_N"], $_POST["Ville_Usager_N"], $_POST["CP_Usager_N"], $_POST["Lieu_Naissance_Usager_N"]));
			
			if($requete->rowCount() == 1) {
				echo('<div id="grande_boite">
						Usager déjà existant.
					  ');
			}
			else {
					$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Num_Securite_Sociale = ?');
					$requete->execute(array($_POST["Num_Secu_Usager_N"]));
			
					if($requete->rowCount() == 1 && $_POST["Num_Secu_Usager_N"] != $_POST["Num_Secu_Usager_A"]) {
						echo('<div id="grande_boite">
								Numéro_sécurité_sociale déjà existant.
					  	');

					} else {
						if ($_POST["Num_Secu_Usager_N"] > 99999999999 or $_POST["Num_Secu_Usager_N"] < 10000000000){
								echo('<div id="grande_boite">
									Numéro securité social incorrect. 
							  	');
						  	echo("<br />");
						  	echo($_POST["Num_Secu_Usager_N"]);
						  	echo("<br />");
						  	echo($_POST["Num_Secu_Usager_A"]);
						  	echo("<br />");
						}
							else if ($_POST["CP_Usager_N"] > 99999 or $_POST["CP_Usager_N"] < 10000){
								echo('<div id="grande_boite">
											Code Postal non existant. 
									  	');
							} 
								else if (!empty($_POST["P_Medecin_Usager_N"]) && !empty($_POST["N_Medecin_Usager_N"])){
									$requete = $linkpdo->prepare('SELECT * FROM Medecin WHERE Nom = ? AND Prenom = ?'); 
									$requete->execute(array($_POST["N_Medecin_Usager_N"], $_POST["P_Medecin_Usager_N"]));
									if($requete->rowCount() == 0 ) {
										echo('<div id="grande_boite">
												Medecin traitant non existant. 
										  	');
										echo('<br />' . $_POST["P_Medecin_Usager_N"] . '<br />');

									} 
									else {
										$requete_M = $linkpdo->prepare('SELECT ID FROM Medecin WHERE Nom = ? AND Prenom = ?');
										$requete_M->execute(array($_POST["N_Medecin_Usager_N"], $_POST["P_Medecin_Usager_N"]));
										while($data = $requete_M->fetch()){
											$Medecin_T=$data[0];
										}
										$requete = $linkpdo->prepare('DELETE FROM Usager WHERE Civilite = ? AND Nom = ? AND Prenom = ? AND Date_Naissance = ? AND Adresse = ? AND Ville = ? AND Code_Postal = ? AND Lieu_Naissance = ?');
										$requete->execute(array($_POST["Civilite_Usager_A"], $_POST["Nom_Usager_A"], $_POST["Prenom_Usager_A"], $_POST["Date_Naissance_Usager_A"], $_POST["Adresse_Usager_A"], $_POST["Ville_Usager_A"], $_POST["CP_Usager_A"], $_POST["Lieu_Naissance_Usager_A"]));
										$requete = $linkpdo->prepare('INSERT INTO Usager (Civilite, Nom, Prenom, Date_Naissance, Adresse, Ville, Code_Postal, Lieu_Naissance, Num_Securite_Sociale, Medecin_T) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
										$requete->execute(array($_POST["Civilite_Usager_N"], $_POST["Nom_Usager_N"], $_POST["Prenom_Usager_N"], $_POST["Date_Naissance_Usager_N"], $_POST["Adresse_Usager_N"], $_POST["Ville_Usager_N"], $_POST["CP_Usager_N"], $_POST["Lieu_Naissance_Usager_N"], $_POST["Num_Secu_Usager_N"], $Medecin_T));
										echo('<div id="grande_boite">
												Usager modifié. 
										  	');
									}
								}
								else {
									$requete = $linkpdo->prepare('DELETE FROM Usager WHERE Civilite = ? AND Nom = ? AND Prenom = ? AND Date_Naissance = ? AND Adresse = ? AND Ville = ? AND Code_Postal = ? AND Lieu_Naissance = ?');
									$requete->execute(array($_POST["Civilite_Usager_A"], $_POST["Nom_Usager_A"], $_POST["Prenom_Usager_A"], $_POST["Date_Naissance_Usager_A"], $_POST["Adresse_Usager_A"], $_POST["Ville_Usager_A"], $_POST["CP_Usager_A"], $_POST["Lieu_Naissance_Usager_A"]));
									$requete = $linkpdo->prepare('INSERT INTO Usager (Civilite, Nom, Prenom, Date_Naissance, Adresse, Ville, Code_Postal, Lieu_Naissance, Num_Securite_Sociale) values (?, ?, ?, ?, ?, ?, ?, ?, ?)');
									$requete->execute(array($_POST["Civilite_Usager_N"], $_POST["Nom_Usager_N"], $_POST["Prenom_Usager_N"], $_POST["Date_Naissance_Usager_N"], $_POST["Adresse_Usager_N"], $_POST["Ville_Usager_N"], $_POST["CP_Usager_N"], $_POST["Lieu_Naissance_Usager_N"], $_POST["Num_Secu_Usager_N"]));
									echo('<div id="grande_boite">
												Usager modifié.
										  	  ');
									
								}
							}
						
						
					}
			

		?>
		<button onclick="window.location.href = 'rechercher_usager.php';">Retour</button>
		</div>
	</body>
</html>

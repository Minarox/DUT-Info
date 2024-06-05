<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ajout Usager | Cabinet Médical</title>
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
			$requete->execute(array($_POST["Civilite_Usager"], $_POST["Nom_Usager"], $_POST["Prenom_Usager"], $_POST["Date_Naissance_Usager"], $_POST["Adresse_Usager"], $_POST["Ville_Usager"], $_POST["CP_Usager"], $_POST["Lieu_Naissance_Usager"]));
			
			if($requete->rowCount() == 1) {
				echo('<div id="grande_boite">
						Usager déjà existant.
					  ');
			}
			else {
				if ($_POST["Num_Secu_Usager"] > 99999999999 or $_POST["Num_Secu_Usager"] < 10000000000){
					echo('<div id="grande_boite">
									Numéro securité social incorrect. 
							  	');
				}
					else if ($_POST["CP_Usager"] > 99999 or $_POST["CP_Usager"] < 10000){
						echo('<div id="grande_boite">
									Code Postal non existant. 
							  	');
					} 
						else if (!empty($_POST["Colonne_Medecin"])){
							$requete = $linkpdo->prepare('SELECT * FROM Medecin WHERE ID = ?'); 
							$requete->execute(array($_POST["Colonne_Medecin"]));
							if($requete->rowCount() == 0 ) {
								echo('<div id="grande_boite">
										Medecin traitant non existant. 
								  	');
								echo('<br />' . $_POST["P_Medecin_Usager"] . '<br />');

							} 
							else {

								$requete = $linkpdo->prepare('INSERT INTO Usager (Civilite, Nom, Prenom, Date_Naissance, Adresse, Ville, Code_Postal, Lieu_Naissance, Num_Securite_Sociale, Medecin_T) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
								$requete->execute(array($_POST["Civilite_Usager"], $_POST["Nom_Usager"], $_POST["Prenom_Usager"], $_POST["Date_Naissance_Usager"], $_POST["Adresse_Usager"], $_POST["Ville_Usager"], $_POST["CP_Usager"], $_POST["Lieu_Naissance_Usager"], $_POST["Num_Secu_Usager"], $$_POST["Colonne_Medecin"]));
								echo('<div id="grande_boite">
										Usager crée. 
								  	');
							}
						}
						else {
							$requete = $linkpdo->prepare('INSERT INTO Usager (Civilite, Nom, Prenom, Date_Naissance, Adresse, Ville, Code_Postal, Lieu_Naissance, Num_Securite_Sociale) values (?, ?, ?, ?, ?, ?, ?, ?, ?)');
							$requete->execute(array($_POST["Civilite_Usager"], $_POST["Nom_Usager"], $_POST["Prenom_Usager"], $_POST["Date_Naissance_Usager"], $_POST["Adresse_Usager"], $_POST["Ville_Usager"], $_POST["CP_Usager"], $_POST["Lieu_Naissance_Usager"], $_POST["Num_Secu_Usager"]));
							echo('<div id="grande_boite">
										Usager crée.
								  	  ');
							
						}
					}
		?>
			<button id="retour" onclick="window.location.href = 'ajouter_usager.php';">retour</button>
		</div>
	</body>
</html>

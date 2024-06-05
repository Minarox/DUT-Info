<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Supprimer Usager | Cabinet Médical</title>
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
			$requete->execute(array($_GET["Civilite_Usager"], $_GET["Nom_Usager"], $_GET["Prenom_Usager"], $_GET["Date_Naissance_Usager"], $_GET["Adresse_Usager"], $_GET["Ville_Usager"], $_GET["CP_Usager"], $_GET["Lieu_Naissance_Usager"]));
			
			if($requete->rowCount() == 0) {
				echo('<div id="grande_boite">
						Usager non existant.
					  ');
				echo('<br />');
				echo($GET["Prenom_Usager"]);
			}
			else {
				$id;
				$requete = $linkpdo->prepare('SELECT Id_Usager FROM Usager WHERE Civilite = ? AND Nom = ? AND Prenom = ? AND Date_Naissance = ? AND Adresse = ? AND Ville = ? AND Code_Postal = ? AND Lieu_Naissance = ?');
				$requete->execute(array($_GET["Civilite_Usager"], $_GET["Nom_Usager"], $_GET["Prenom_Usager"], $_GET["Date_Naissance_Usager"], $_GET["Adresse_Usager"], $_GET["Ville_Usager"], $_GET["CP_Usager"], $_GET["Lieu_Naissance_Usager"]));
				while($data = $requete->fetch()){
					$id = $data[0];
				}
				$requete = $linkpdo->prepare('DELETE FROM RendezVous WHERE Id_Usager = ?');
				$requete->execute(array($id));


				$requete = $linkpdo->prepare('DELETE FROM Usager WHERE Civilite = ? AND Nom = ? AND Prenom = ? AND Date_Naissance = ? AND Adresse = ? AND Ville = ? AND Code_Postal = ? AND Lieu_Naissance = ?');
				$requete->execute(array($_GET["Civilite_Usager"], $_GET["Nom_Usager"], $_GET["Prenom_Usager"], $_GET["Date_Naissance_Usager"], $_GET["Adresse_Usager"], $_GET["Ville_Usager"], $_GET["CP_Usager"], $_GET["Lieu_Naissance_Usager"]));
				echo('<div id="grande_boite">
						Usager supprimé.
						');
			}
			

		?>
		<button onclick="window.location.href = 'rechercher_usager.php';">Retour</button>
		</div>
	</body>
</html>

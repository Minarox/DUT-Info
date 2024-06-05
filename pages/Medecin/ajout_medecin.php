<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ajout Médecin | Cabinet Médical</title>
        <link rel="stylesheet" href="../../assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php" class="active">Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		<?php
            require('../PHP/db.php');
			
			$requete = $linkpdo->prepare('SELECT * FROM Medecin WHERE Civilite = ? AND Nom = ? AND Prenom = ?');
			$requete->execute(array($_POST["Civilite_Medecin"], $_POST["Nom_Medecin"], $_POST["Prenom_Medecin"]));
			
			if($requete->rowCount() == 1) {
				echo('<div id="grande_boite">
						Medecin déjà existant.
					  ');
			}
			else {

					$requete = $linkpdo->prepare('INSERT INTO Medecin (Civilite, Nom, Prenom) values (?, ?, ?)');
					$requete->execute(array($_POST["Civilite_Medecin"], $_POST["Nom_Medecin"], $_POST["Prenom_Medecin"]));
					echo('<div id="grande_boite">
							Medecin crée.
					  	  ');
			}
		?>
			<button id="retour" onclick="window.location.href = 'ajouter_medecin.php';">retour</button>
		</div>
	</body>
</html>

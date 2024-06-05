<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Edit Médecin | Cabinet Médical</title>
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
			$requete->execute(array($_POST["Civilite_Medecin_N"], $_POST["Nom_Medecin_N"], $_POST["Prenom_Medecin_N"]));
			
			if($requete->rowCount() == 1) {
				echo('<div id="grande_boite">
						Medecin déjà existant(e).
					  ');
			}
			else {
					$requete = $linkpdo->prepare('DELETE FROM Medecin WHERE Civilite = ? AND Nom = ? AND Prenom = ?');
					$requete->execute(array($_POST["Civilite_Medecin_A"], $_POST["Nom_Medecin_A"], $_POST["Prenom_Medecin_A"]));
					$requete = $linkpdo->prepare('INSERT INTO Medecin (Civilite, Nom, Prenom) values (?, ?, ?)');
					$requete->execute(array($_POST["Civilite_Medecin_N"], $_POST["Nom_Medecin_N"], $_POST["Prenom_Medecin_N"]));
					echo('<div id="grande_boite">
							Medecin modifié(e).
					  	  ');
			}
	
		?>
		<button onclick="window.location.href = 'rechercher_medecin.php';">Retour</button>
		</div>
	</body>
</html>

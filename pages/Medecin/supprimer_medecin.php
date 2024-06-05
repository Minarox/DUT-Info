<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Supprimer Médecin | Cabinet Médical</title>
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
			$requete->execute(array($_GET["Civilite_Medecin"], $_GET["Nom_Medecin"], $_GET["Prenom_Medecin"]));
			
			if($requete->rowCount() == 0) {
				echo('<div id="grande_boite">
						Medecin non existant(e).
					  ');
			}
			else {
					$id;
					$requete_medecin = $linkpdo->prepare('SELECT ID FROM Medecin WHERE Civilite = ? AND Nom = ? AND Prenom = ?');
					$requete_medecin->execute(array($_GET["Civilite_Medecin"], $_GET["Nom_Medecin"], $_GET["Prenom_Medecin"]));
					while($data = $requete_medecin->fetch()){
						$id=$data[0];
					}
					$requete = $linkpdo->prepare('DELETE FROM RendezVous WHERE Id_Medecin = ?');
					$requete->execute(array($id));
					$requete = $linkpdo->prepare('DELETE FROM Medecin WHERE Civilite = ? AND Nom = ? AND Prenom = ?');
					$requete->execute(array($_GET["Civilite_Medecin"], $_GET["Nom_Medecin"], $_GET["Prenom_Medecin"]));
					
					echo('<div id="grande_boite">
							Medecin supprimé(e).
					  	  ');
			}
	
		?>
		<button onclick="window.location.href = 'rechercher_medecin.php';">Retour</button>
		</div>
	</body>
</html>

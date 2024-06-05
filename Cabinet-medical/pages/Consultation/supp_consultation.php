<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Supp Usager | Cabinet Médical</title>
        <link rel="stylesheet" href="../../assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php" >Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php" >Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php" class="active">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		<?php
            require('../PHP/db.php');
			$requete = $linkpdo->prepare('SELECT * FROM RendezVous WHERE Date_RDV = ? AND Heure = ? AND Id_Medecin = ? AND Id_Usager = ?');
			$requete->execute(array($_GET["Date_RDV"], $_GET["Heure_RDV"], $_GET["Medecin_RDV"], $_GET["Usager_RDV"]));
			if($requete->rowCount() == 0) {
					echo('<div id="grande_boite">
						RDV non existant.
					  ');
					echo('<br />');
			}
			else {
				$requete = $linkpdo->prepare('DELETE FROM RendezVous WHERE Date_RDV = ? AND Heure = ? AND Id_Usager = ? AND Id_Medecin = ?');
				$requete->execute(array($_GET["Date_RDV"], $_GET["Heure_RDV"],$_GET["Usager_RDV"], $_GET["Medecin_RDV"]));
				echo('<div id="grande_boite">
						RDV effacé.
					  ');
			}
		?>
			<button id="retour" onclick="window.location.href = 'rechercher_consultation.php';">retour</button>
		</div>
	</body>
</html>

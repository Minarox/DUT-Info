<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Gérer Médecins | Cabinet médical</title>
        <link rel="stylesheet" href="../assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="../index.php">Accueil</a></li>
			<li id="Bouton"><a href="Usager.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="Medecin.php" class="active">Gérer Médecins</a></li>
			<li id="Bouton"><a href="Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		
		<div id="petite_boite">
			<h1>Gestion des médecins</h1>

			<table id="sous-menu">
				<tr>
					<td><button onclick="window.location.href = 'Medecin/rechercher_medecin.php';">Rechercher</button></td>
					<td><button onclick="window.location.href = 'Medecin/ajouter_medecin.php';">Ajouter</button></td>
					<td><button onclick="window.location.href = 'Medecin/rechercher_medecin.php';">Modifier</button></td>
					<td><button onclick="window.location.href = 'Medecin/rechercher_medecin.php';">Supprimer</button></td>
				</tr>
				<tr>
					<td colspan="4"><button id="retour" onclick="window.location.href = '../index.php';">Retour</button></td>
				</tr>
			</table>		
        </div>
	</body>
</html>
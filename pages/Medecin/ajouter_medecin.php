<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ajouter Médecin | Cabinet Médical</title>
        <link rel="stylesheet" href="../../assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usagers.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php" class="active">Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		
		<div id="petite_boite">
			<h1>Ajouter un médecin</h1>

			<form action="ajout_medecin.php" method="POST">
				<table id="formulaire">
					<tr>
						<td><label><strong>Civilité</strong></label></td>
						<td>
							<select name="Civilite_Medecin" required>
								<option value="">Choisir une civilité</option>
								<option value="Mr">Monsieur</option>
								<option value="MMe">Madame</option>
								<option value="NR">Non renseigné</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label><strong>Nom</strong></label></td>
						<td><input type="text" placeholder="Nom du médecin" name="Nom_Medecin" required></td>
					</tr>
					<tr>
						<td><label><strong>Prénom</strong></label></td>
						<td><input type="text" placeholder="Prénom du médecin" name="Prenom_Medecin" required></td>
					</tr>
					<tr>
						<td colspan="2"><input type="submit"></td>
					</tr>
				</table>
			</form>
						<button onclick="window.location.href = '../Medecin.php';">Retour</button>
				
        </div>
	</body>
</html>
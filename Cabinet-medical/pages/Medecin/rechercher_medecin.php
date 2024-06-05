<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Rechercher Médecin  | Cabinet médical</title>
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
		
		<div id="grande_boite">
			<h1>Rechercher un médecin</h1>
	
			<form action="rechercher_medecin.php" method="POST">
				<table id="recherche">
					<tr>
						<td><p><strong>Recherche rapide :</strong></p></td>
						<td><input type="search" placeholder="Élément à rechercher" name="Recherche"></td>
						<td><p>dans</p></td>
						<td>
							<select name="Colonne">
								<option name="">Choisir une colonne</option>
								<option value="Civilite_Medecin">Civilité</option>
								<option value="Nom_Medecin">Nom</option>
								<option value="Prenom_Medecin">Prénom</option>
							</select>
						</td>
						<td><input type="submit"></td>					
					</tr>
				</table>		
			</form>
			
			<table id="tableau">
				<tr>
					<th scope="col">Civlité</th>
					<th scope="col">Nom</th>
					<th scope="col">Prénom</th>
					<th scope="col">Actions</th>
				</tr>
		<?php
            require('../PHP/db.php');
			if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Civilite_Medecin"){
				$requete = $linkpdo->prepare('SELECT * FROM Medecin WHERE Civilite = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"])  && $_POST["Colonne"] == "Nom_Medecin"){
				$requete = $linkpdo->prepare('SELECT * FROM Medecin WHERE Nom = ?');
				$requete->execute(array($_POST["Recherche"]));
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Prenom_Medecin"){
				$requete = $linkpdo->prepare('SELECT * FROM Medecin WHERE Prenom = ?');
				$requete->execute(array($_POST["Recherche"]));
			}
			else{
				$requete = $linkpdo->prepare('SELECT * FROM Medecin');
				$requete->execute(array());
			}
			while($data = $requete->fetch()){
				echo("<tr>
					<td>$data[1]</td>
					<td>$data[2]</td>
					<td>$data[3]</td>
					<td>
						<a href='editer_medecin.php?Civilite_Medecin=$data[1]&amp;Nom_Medecin=$data[2]&amp;Prenom_Medecin=$data[3]&amp;'><img id='icon' src='../../assets/images/editer.png' /></a>
						<a href='supprimer_medecin.php?Civilite_Medecin=$data[1]&amp;Nom_Medecin=$data[2]&amp;Prenom_Medecin=$data[3]&amp;'><img id='icon' src='../../assets/images/supprimer.png' /></a>
					</td>
				</tr>");
			}
		?>
			</table>

			<table id="recherche">
				<tr>
					<td><button id="retour" onclick="window.location.href = 'ajouter_medecin.php';">Ajouter</button></td>
					<td><button id="retour" onclick="window.location.href = '../Medecin.php';">Retour</button></td>
				</tr>
			</table>		
        </div>
	</body>
</html>

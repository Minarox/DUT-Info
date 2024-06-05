<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Rechercher Usager | Cabinet médical</title>
		<link rel="stylesheet" href="../../assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php" class="active">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php">Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		
		<div id="grande_boite">
			<h1>Rechercher un usager</h1>
	
			<form action="rechercher_usager.php" method="POST">
				<table id="recherche">
					<tr>
						<td><p><strong>Recherche rapide :</strong></p></td>
						<td><input type="search" placeholder="Élément à rechercher" name="Recherche"></td>
						<td><p>dans</p></td>
						<td>
							<select name="Colonne">
								<option value="">Choisir une colonne</option>
								<option value="Civilite_Usager">Civilité</option>
								<option value="Nom_Usager">Nom</option>
								<option value="Prenom_Usager">Prénom</option>
								<option value="Adresse_Usager">Adresse</option>
								<option value="Ville_Usager">Ville</option>
								<option value="CP_Usager">Code Postal</option>
								<option value="Date_Naissance_Usager" >Date de Naissance</option>
								<option value="Lieu_Naissance_Usager">Lieu de naissance</option>
								<option value="Medecin_Usager">Nom Médecin</option>
							</select>
						</td>
						<td><input type="submit"></td>					
					</tr>
				</table>		
			</form>

			<table id="tableau">
				<tr>
					<th scope="col">Civilité</th>
					<th scope="col">Nom</th>
					<th scope="col">Prénom</th>
					<th scope="col">Adresse</th>
					<th scope="col">Ville</th>
					<th scope="col">Code Postal</th>
					<th scope="col">Date de Naissance</th>
					<th scope="col">Lieu de naissance</th>
					<th scope="col">Numéro de Sécurité Sociale</th>
					<th scope="col">Medecin traitant</th>
					<th scope="col">Actions</th>
				</tr>
		<?php
            require('../PHP/db.php');
			if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Civilite_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Civilite = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Nom_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Nom = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Prenom_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Prenom = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Adresse_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Adresse = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Ville_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Ville = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "CP_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Code_Postal = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Date_Naissance_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Date_Naissance = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else if(isset($_POST["Recherche"]) && $_POST["Colonne"] == "Lieu_Naissance_Usager"){
				$requete = $linkpdo->prepare('SELECT * FROM Usager WHERE Lieu_Naissance = ?');
				$requete->execute(array($_POST["Recherche"]));				
			}
			else{
				$requete = $linkpdo->prepare('SELECT * FROM Usager');
				$requete->execute(array());
			}
			while($data = $requete->fetch()){
				$requete_M = $linkpdo->prepare('SELECT Nom,Prenom FROM Medecin WHERE ID = ?');
				$requete_M->execute(array($data[10]));
				while($data1 = $requete_M->fetch()){
					$Nom_M=$data1[0] . " " . $data1[1];
					$NM = $data1[0];
					$PM = $data1[1];
					
				}
				$date = date_create_from_format('Y-m-d', $data[4]);
				$date1 = date_format($date, 'j/m/Y');
				echo("
					<tr>
						<td>$data[1]</td>
						<td>$data[2]</td>
						<td>$data[3]</td>
						<td>$data[5]</td>
						<td>$data[6]</td>
						<td>$data[7]</td>
						<td>$date1</td>
						<td>$data[8]</td>
						<td>$data[9]</td>
						<td>$Nom_M</td>
						<td align='center'>
							<a href='editer_usager.php?Civilite_Usager=$data[1]&amp;Nom_Usager=$data[2]&amp;Prenom_Usager=$data[3]&amp;Date_Naissance_Usager=$data[4]&amp;Adresse_Usager=$data[5]&amp;Ville_Usager=$data[6]&amp;CP_Usager=$data[7]&amp;Lieu_Naissance_Usager=$data[8]&amp;Num_Secu_Usager=$data[9]&amp;Medecin_Nom=$NM&amp;Medecin_Prenom=$PM&amp; Medecin_T=$data[10]&amp;'><img id='icon' src='../../assets/images/editer.png'/></a>
							<a href='supp_usager.php?Civilite_Usager=$data[1]&amp;Nom_Usager=$data[2]&amp;Prenom_Usager=$data[3]&amp;Date_Naissance_Usager=$data[4]&amp;Adresse_Usager=$data[5]&amp;Ville_Usager=$data[6]&amp;CP_Usager=$data[7]&amp;Lieu_Naissance_Usager=$data[8]&amp;Num_Secu_Usager=$data[9]&amp;Medecin_Nom=$NM&amp;Medecin_Prenom=$PM&amp; Medecin_T=$data[10]&amp;'><img id='icon' src='../../assets/images/supprimer.png' /></a>
						</td>
					</tr>
				");
			}
		?>
			</table>
			<table id="recherche">
				<tr>
					<td><button id="retour" onclick="window.location.href = 'ajouter_usager.php?';">Ajouter</button></td>
					<td><button id="retour" onclick="window.location.href = '../Usager.php';">Retour</button></td>
				</tr>
			</table>		
        </div>
	</body>
</html>


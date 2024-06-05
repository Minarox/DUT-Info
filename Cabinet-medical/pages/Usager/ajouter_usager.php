<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Ajouter Usager | Cabinet Médical</title>
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
		
		<div id="petite_boite">
			<h1>Ajouter un usager</h1>

			<form action="ajout_usager.php" method="POST">
				<table id="formulaire">
					<tr>
						<td><label><strong>Civilité</strong></label></td>
						<td>
							<select name="Civilite_Usager" required>
								<option value="">Choisir une civilité</option>
								<option value="Mr">Monsieur</option>
								<option value="MMe">Madame</option>
								<option value="NR">Non renseigné</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><label><strong>Nom</strong></label></td>
						<td><input type="text" placeholder="Nom de l'usager" name="Nom_Usager" required></td>
					</tr>
					<tr>
						<td><label><strong>Prénom</strong></label></td>
						<td><input type="text" placeholder="Prénom de l'usager" name="Prenom_Usager" required></td>
					</tr>
					<tr>
						<td><label><strong>Adresse</strong></label></td>
						<td><input type="text" placeholder="Adresse de l'usager" name="Adresse_Usager" required></td>
					</tr>
					<tr>
						<td><label><strong>Ville</strong></label></td>
						<td><input type="text" placeholder="Ville de l'usager" name="Ville_Usager" required></td>
					</tr>
					<tr>
						<td><label><strong>Code Postal</strong></label></td>
						<td><input type="number" placeholder="Code postal de la ville de l'usager" name="CP_Usager" required></td>
					</tr>
					<tr>
						<td><label><strong>Date de naissance</strong></label></td>
						<td><input type="date" name="Date_Naissance_Usager" required
							<?php
							$date_A = date('Y-m-d'); 
							$annee_min = intval(date('Y')) - 150 ;
				
							echo (' min= "'.$annee_min . '-' . date('m') . '-' . date('d').'" ');
							echo(' max = "'.date('Y-m-d').'" ');
							?>
							></td>
					</tr>
					<tr>
						<td><label><strong>Lieu de naissance</strong></label></td>
						<td><input type="text" placeholder="Lieu de naissance de l'usager" name="Lieu_Naissance_Usager" required></td>
					</tr>
					<tr>
						<td><label><strong>Numéro Sécurité Sociale</strong></label></td>
						<td><input type="number" placeholder="Numéro de Sécurité Sociale" name="Num_Secu_Usager" required></td>
					</tr>
					<tr>
						<td><label><strong>Médecin Traitant</strong></label></td>
						<td>
							<select name="Colonne_Medecin">
									<option value="">Sélectionner le médecin</option>
									<?php
                                        require('../PHP/db.php');
										$contenu_medecin= array();
										$requete_medecin = $linkpdo->prepare('SELECT * FROM Medecin');
										$requete_medecin->execute(array());
										while($data = $requete_medecin->fetch()){
											$contenu_medecin[] = $data[1] . " " . $data[2] . " " . $data[3];
											$id_medecin[] = $data[0];
										}
										for($i = 0; $i < count($contenu_medecin); $i ++){
											echo('<option value='.$id_medecin[$i].'>'.$contenu_medecin[$i].'</option>');
										}
									?>
							</select>
						</td>
					</tr>

							
					<tr>
						<td colspan="2"><input type="submit"></td>
					</tr>
				</table>
			</form>
						<button onclick="window.location.href = '	../Usager.php';">Retour</button>
					
				
        </div>
	</body>
</html>

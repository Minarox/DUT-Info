<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>

	<head>
		<meta charset="utf-8">
		<title>Ajouter Consultation | Cabinet Médical</title>
        <link rel="stylesheet" href="../../assets/style.css" />
	</head>

	<body>
		
		<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php">Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php" class="active">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		
		<div id="petite_boite">
			<h1>Ajouter une consultation</h1>
			<form action="ajout_consultation.php" method="POST">
				<table id="formulaire">
					<tr>
	    				<td><label><strong>Date</strong></label></td>
						<td><input type="date" name="Date_RDV" required
						<?php
							echo (' min= "'. date('Y') . '-' . date('m') . '-' . date('d').'" ');
						?>
							></td>
					</tr>
					<tr>
						<td><label><strong>Heure</strong></label></td>
						<td><input type="time" name="Heure_RDV" required></td>
					</tr>
					<tr>
						<td><label><strong>Durée (en min)</strong></label></td>
						<td><input type="number" placeholder="Durée de la consultation" name="Duree_RDV" value="30" required></td>
					</tr>
					<tr>
						<td><label><strong>Usager</strong></label></td>
						<td>
							<select name="Usager_RDV" required>
								<option value="">Sélectionner l'usager</option>
								<?php
                                    require('../PHP/db.php');
									$contenu_usager= array();
									$requete_usager = $linkpdo->prepare('SELECT * FROM Usager');
									$requete_usager->execute(array());
									while($data = $requete_usager->fetch()){
										$contenu_usager[] = $data[1] . " " . $data[2] . " " . $data[3];
										$id_usager[] = $data[0];
										$medecin_traitant[] = $data[10];
									}
									for($i = 0; $i < count($contenu_usager); $i ++){
										echo('<option value='.$id_usager[$i].'>'.$contenu_usager[$i]);
										echo('</option>');
									}
								?>
							</select>	
						</td>
					</tr>
					<tr>
						<td><label><strong>Médecin</strong></label></td>
						<td>
							<select name="Medecin_RDV" required>
								<option value="">Sélectionner le médecin</option>
								<?php
									try {
										$linkpdo = new PDO("mysql:host={nom_hote};dbname={nom_db}", "{utilisateur}", "{mdp}");
									}
									catch (Exception $e){
										die("Erreur : ".$e->getMessage());
									}
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
			<button onclick="window.location.href = '../Consultation.php';">Retour</button>
        </div>
	</body>
</html>

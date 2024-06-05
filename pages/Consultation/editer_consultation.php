<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Editer Consultation | Cabinet Médical</title>
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
			<h1>Editer une consultation</h1>
			
			<?php
                require('../PHP/db.php');

				function minutes($temps){
					$timeParts = explode(':', $temps);
					$timeString = $timeParts[0];
					$timeString1= $timeParts[1];
					return $timeString . ":" . $timeString1;
				}
				$heure = minutes($_GET["Heure_RDV"]);
				if (isset($_GET["Date_RDV"]) && isset($_GET["Heure_RDV"]) && isset($_GET["Usager_RDV"]) && isset($_GET["Medecin_RDV"]) && isset($_GET["Duree_RDV"])) {
					echo('
						<form action="edit_consultation.php" method="POST">
							<input type="hidden" name="Date_RDV_A" value='.$_GET["Date_RDV"].'></input>
							<input type="hidden" name="Heure_RDV_A" value='.$_GET["Heure_RDV"].'></input>
							<input type="hidden" name="Usager_RDV_A" value='.$_GET["Usager_RDV"].'></input>
							<input type="hidden" name="Medecin_RDV_A" value='.$_GET["Medecin_RDV"].'></input>
							<input type="hidden" name="Duree_RDV_A" value='.$_GET["Duree_RDV"].'></input>
							<table id="formulaire">
								<tr>
				    				<td><label><strong>Date</strong></label></td>
									<td><input type="date" name="Date_RDV" required value='.$_GET["Date_RDV"].'
					');
										echo (' min= "'. date('Y') . '-' . date('m') . '-' . date('d').'" ');
					echo('
										></td>
								</tr>
								<tr>
									<td><label><strong>Heure</strong></label></td>
									<td><input type="time" name="Heure_RDV" required value='.$heure.'></td>
								</tr>
								<tr>
									<td><label><strong>Durée (en min)</strong></label></td>
									<td><input type="number" placeholder="Durée de la consultation" name="Duree_RDV" value='.$_GET["Duree_RDV"].' required ></td>
								</tr>
								<tr>
									<td><label><strong>Usager</strong></label></td>
									<td>
										<select name="Usager_RDV" required>
											<option value='.$_GET["Usager_RDV"].'>'.$_GET["U"].'</option>
					');

												$contenu_usager_A= array();
												$requete_usager_A = $linkpdo->prepare('SELECT * FROM Usager');
												$requete_usager_A->execute(array());
												while($data_A = $requete_usager_A->fetch()){
													$contenu_usager_A[] = $data_A[1] . " " . $data_A[2] . " " . $data_A[3];
													$id_usager_A[] = $data_A[0];
													$medecin_traitant_A[] = $data_A[10];
												}
												for($i = 0; $i < count($contenu_usager_A); $i ++){
													echo('<option value='.$id_usager_A[$i].'>'.$contenu_usager_A[$i]);
													echo('</option>');
												}
					echo('
										</select>	
									</td>
								</tr>
								<tr>
									<td><label><strong>Médecin</strong></label></td>
									<td>
										<select name="Medecin_RDV" required>
											<option value='.$_GET["Usager_RDV"].'>'.$_GET["M"].'</option>
					');
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

					echo('
										</select>
									</td>
								</tr>
								<tr>
									<td colspan="2"><input type="submit"></td>
								</tr>
							</table>
						</form>
					');
				}
			?>

			<button onclick="window.location.href = 'rechercher_consultation.php';">Retour</button>
        </div>
	</body>
</html>

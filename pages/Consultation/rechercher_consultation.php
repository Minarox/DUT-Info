<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Rechercher Consultation | Cabinet médical</title>
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
		
		<div id="grande_boite">
			<h1>Rechercher une consultation</h1>
	
			<form action="rechercher_consultation.php" method="POST">
				<table id="recherche">
					<tr>
						<td><p><strong>Recherche rapide par médecins :</strong></p></td>
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
						<td><input type="submit"></td>					
					</tr>
				</table>		
			</form>
			
			<table id="tableau">
				<tr>
					<th scope="col">Date du Rendez-Vous</th>
					<th scope="col">Heure du Rendez-Vous</th>
					<th scope="col">Durée</th>
					<th scope="col">Médecin</th>
					<th scope="col">Usager</th>
					<th scope="col">Action</th>
				</tr>
					<?php
                        require('../PHP/db.php');
						if(!empty($_POST["Colonne_Medecin"])){
							$requete_Medecin = $linkpdo->prepare('SELECT * FROM Medecin WHERE ID = ?');
							$requete_Medecin->execute(array($_POST["Colonne_Medecin"]));
							while($data_Medecin = $requete_Medecin->fetch()){
								$Nom_med=$data_Medecin[2];
								$Prenom_med=$data_Medecin[3];
							}
							$identite_M = $Nom_med . " " . $Prenom_med;
							$requete = $linkpdo->prepare('SELECT * FROM RendezVous WHERE Id_Medecin = ?');
							$requete->execute(array($_POST["Colonne_Medecin"]));
							while($data = $requete->fetch()){
								$date = date_create_from_format('Y-m-d', $data[0]);
								$date1 = date_format($date, 'j/m/Y');
								echo("<tr>
										<td>$date1</td>
										<td>$data[1]</td>
										<td>$data[4]</td>
										<td>$identite_M</td>
										
								");
								$requete_Usager = $linkpdo->prepare('SELECT * FROM Usager WHERE Id_Usager = ?');
								$requete_Usager->execute(array($data[2]));
								while($data_Usager = $requete_Usager->fetch()){
									$Nom_usa=$data_Usager[2];
									$Prenom_usa=$data_Usager[3];
								}
								$usager_lie= $Nom_usa . " " . $Prenom_usa;
								echo("
										<td>$usager_lie</td>
										<td>
											<a href='diter_consultation.php?Date_RDV=$data[0]&amp;Heure_RDV=$data[1]&amp;Usager_RDV=$data[2]&amp;Medecin_RDV=$data[3]&amp;Duree_RDV=$data[4]&amp;U=$usager_lie&amp;M=$identite_M&amp;'><img id='icon' src='../../assets/images/editer.png' /></a>
											<a href='supp_consultation.php?Date_RDV=$data[0]&amp;Heure_RDV=$data[1]&amp;Usager_RDV=$data[2]&amp;Medecin_RDV=$data[3]&amp;Duree_RDV=$data[4]&amp;U=$usager_lie&amp;M=$identite_M&amp;'><img id='icon' src='../../assets/images/supprimer.png' /></a>
										</td>
									</tr>");
							}
						}
						else{
							$requete = $linkpdo->prepare('SELECT * FROM RendezVous');
							$requete->execute(array());
							while($data = $requete->fetch()){
								$o+=1;
								$date = date_create_from_format('Y-m-d', $data[0]);
								$date1 = date_format($date, 'j-m-Y');
								echo("<tr>
										<td>$date1</td>
										<td>$data[1]</td>
										<td>$data[4]</td>
								");	
								$requete_Medecin = $linkpdo->prepare('SELECT * FROM Medecin WHERE ID = ?');
								$requete_Medecin->execute(array($data[3]));
								while($data_Medecin = $requete_Medecin->fetch()){
									$Nom_med=$data_Medecin[2];
									$Prenom_med=$data_Medecin[3];
								}
								$identite_M = $Nom_med . " " . $Prenom_med;
								echo("<td>$identite_M</td>");
								

								$requete_Usager = $linkpdo->prepare('SELECT * FROM Usager WHERE Id_Usager = ?');
								$requete_Usager->execute(array($data[2]));
								while($data_Usager = $requete_Usager->fetch()){
									$Nom_usa=$data_Usager[2];
									$Prenom_usa=$data_Usager[3];
								}
								$usager_lie= $Nom_usa . " " . $Prenom_usa;
								echo("
										<td>$usager_lie</td>
										<td>
											<a href='editer_consultation.php?Date_RDV=$data[0]&amp;Heure_RDV=$data[1]&amp;Usager_RDV=$data[2]&amp;Medecin_RDV=$data[3]&amp;Duree_RDV=$data[4]&amp;U=$usager_lie&amp;M=$identite_M&amp;'><img id='icon' src='../../assets/images/editer.png' /></a>
											<a href='supp_consultation.php?Date_RDV=$data[0]&amp;Heure_RDV=$data[1]&amp;Usager_RDV=$data[2]&amp;Medecin_RDV=$data[3]&amp;Duree_RDV=$data[4]&amp;U=$usager_lie&amp;M=$identite_M&amp;'><img id='icon' src='../../assets/images/supprimer.png' /></a>
										</td>
									</tr>");
							}
						}
								
						
					?>
					
				</tr>
				
			</table>
			<table id="recherche">
				<tr>
					<td><button id="retour" onclick="window.location.href = 'ajouter_consultation.php';">Ajouter</button></td>
					<td><button id="retour" onclick="window.location.href = '../Consultation.php';">Retour</button></td>
				</tr>
			</table>	
        </div>
	</body>
</html>

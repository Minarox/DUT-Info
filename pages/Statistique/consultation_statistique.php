<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Statistiques | Cabinet médical</title>
        <link rel="stylesheet" href="../../assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php">Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php" class="active">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		
		<div id="grande_boite">
			<h1>Durée totale des consultations effectuées par chaque médecin</h1>
			
			<table id="tableau">
				<tr>
					<th scope="col">Médecin</th>
					<th scope="col">Durée totale des consultations (en heures)</th>
				</tr>

		<?php
            require('../PHP/db.php');
			function minutes($temps){
					$timeParts = explode(':', $temps);
					$timeString = $timeParts[0];
					$timeString1= $timeParts[1];
					return $timeString1;
			}
			function heure_totale($temps){
				$heure=0;
				while($temps>=60){
					$temps-=60;
					$heure+=1;
				}
				return $heure . ":" . $temps;
			}
			$medecin=" ";
			$requete = $linkpdo->prepare('SELECT Nom,Prenom,Civilite FROM Medecin');
			$requete->execute(array());
			while($data = $requete->fetch()){
				$medecin = $data[2] ." " . $data[0] . " " . $data[1];
				echo("<tr>
					<td>$medecin</td>
					
				");
				$id;
				$requete_medecin = $linkpdo->prepare('SELECT ID FROM Medecin WHERE Civilite = ? AND Nom = ? AND Prenom = ?');
				$requete_medecin->execute(array($data[2], $data[0], $data[1]));
				while($data_m = $requete_medecin->fetch()){
						$id=$data_m[0];
				}
				$requete_medecin1 = $linkpdo->prepare('SELECT Duree FROM RendezVous WHERE Id_Medecin = ?');
				$requete_medecin1->execute(array($id));
				$temps_en_minutes = 0;
				while($data_m1 = $requete_medecin1->fetch()){
					$temps_en_minutes+=$data_m1[0];			
				}
				echo("<td>".heure_totale($temps_en_minutes)."</td>
				
				</tr>");
			}
		?>
			</table>

			<table id="recherche">
				<tr>
					<td><button id="retour" onclick="window.location.href = '../Statistique.php';">Retour</button></td>
				</tr>
			</table>		
        </div>
	</body>
</html>

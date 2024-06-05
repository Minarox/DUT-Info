<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Ajout Consultation</title>
        <link rel="stylesheet" href="../../assets/style.css" />
    </head>
    <body>
    	<ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php" >Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php" class="active">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
    	<?php
            require('../PHP/db.php');
			function minutes($temps){
				$timeParts = explode(':', $temps);
				$timeString = $timeParts[0];
				$timeString1= $timeParts[1];
				return $heuresEnMinutes =  intval($timeString)*60+intval($timeString1);
			}
			$duree_RDV = minutes($_POST["Heure_RDV"]);
			$requete = $linkpdo->prepare('SELECT * FROM RendezVous WHERE Date_RDV = ? AND Heure = ? AND Id_Usager = ?');
			$requete->execute(array($_POST["Date_RDV"], $_POST["Heure_RDV"], $_POST["Usager_RDV"]));
			if($requete->rowCount() == 1) {
				echo('<div id="grande_boite">
						RDV déjà existant pour usager.
					  ');
			}
			else {
				$requete = $linkpdo->prepare('SELECT * FROM RendezVous WHERE Date_RDV = ? AND Heure = ? AND Id_Medecin = ?');
				$requete->execute(array($_POST["Date_RDV"], $_POST["Heure_RDV"], $_POST["Medecin_RDV"]));
				if($requete->rowCount() == 1) {
					echo('<div id="grande_boite">
						RDV déjà existant pour medecin.
					  ');
				}
				else {
					$requete_u = $linkpdo->prepare('SELECT * FROM RendezVous WHERE Date_RDV = ? AND Id_Medecin = ?');
					$requete_u->execute(array($_POST["Date_RDV"], $_POST["Medecin_RDV"]));
					$marqueur = 0;
					if($requete_u->rowCount() >= 1) {
						while($data = $requete_u->fetch()){
							$duree_RDV_A=minutes($data[1]);
							if($duree_RDV_A <= $duree_RDV && $duree_RDV < $duree_RDV_A+$data[4]){
								$marqueur=2;
							}
							if($duree_RDV <= $duree_RDV_A  && $duree_RDV_A < $duree_RDV+$_POST["Duree_RDV"]){
									$marqueur = 1;
							}
							
						}
						if($marqueur != 0){
							echo('<div id="grande_boite">
									RDV se chevauchent: 
					  	  	');
						}
						else {
							$requete = $linkpdo->prepare('INSERT INTO RendezVous (Date_RDV, Heure, Id_Usager, Id_Medecin, Duree) values (?, ?, ?, ?, ?)');
							$requete->execute(array($_POST["Date_RDV"], $_POST["Heure_RDV"], $_POST["Usager_RDV"], $_POST["Medecin_RDV"], $_POST["Duree_RDV"]));
							echo('<div id="grande_boite">
									RDV crée.
							  	  ');
						}
					}
					$requete = $linkpdo->prepare('INSERT INTO RendezVous (Date_RDV, Heure, Id_Usager, Id_Medecin, Duree) values (?, ?, ?, ?, ?)');
					$requete->execute(array($_POST["Date_RDV"], $_POST["Heure_RDV"], $_POST["Usager_RDV"], $_POST["Medecin_RDV"], $_POST["Duree_RDV"]));
					echo('<div id="grande_boite">
									RDV crée.
						');
					
				}
			}
		?>
		<button id="retour" onclick="window.location.href = 'ajouter_consultation.php';">retour</button>
		</div>
	</body>
</html>

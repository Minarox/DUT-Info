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
			<h1>Répartition des usagers selon leur sexe et leur âge</h1>
			<?php
                require('../PHP/db.php');
				function age($date){
					$age = date('Y') - date('Y', strtotime($date));
					if (date('md') < date('md', strtotime($date))) {
						return $age - 1;
					}
					return $age;
				}
			
			?>
			<table id="tableau">
				<tr>
					<th scope="col">Tranche d'âge</th>
					<th scope="col">Nombre d'Homme</th>
					<th scope="col">Nombre de Femmes</th>
				</tr>
				<tr>
					<td>Moins de 25 ans</td>
					
					<?php
						$nbH=0;
						$nbF=0;
						$genre="";
						$requete = $linkpdo->prepare('SELECT * FROM Usager');
						$requete->execute();	
						
						while($data = $requete->fetch()){
							$requete1 = $linkpdo->prepare('SELECT Civilite FROM Usager WHERE Id_Usager = ?');
							$requete1->execute(array($data[0]));	
							$sexe_av;
							while($data1 = $requete1->fetch()){
								$sexe_av=$data1[0];
							}
							if ($sexe_av == "Mr"){
								$sexe_av = "Homme";
							} else if ($sexe_av == "MMe"){
								$sexe_av = "Femme";
							} else {
								$sexe_av = "NS";
							}
							$age=age($data[4]);
							if ($sexe_av=="Homme" &&  $age< 25){
								$nbH+=1;
							}
							if ($sexe_av=="Femme" && $age < 25){
								$nbF+=1;
							}
						}
						echo("
					<td>$nbH</td>
					<td>$nbF</td>
							");
					?>
				</tr>
				<tr>
					<td>Entre 25 et 50 ans</td>
					<?php
						$nbH=0;
						$nbF=0;
						$genre="";
						$requete = $linkpdo->prepare('SELECT * FROM Usager');
						$requete->execute();	
						
						while($data = $requete->fetch()){
							$requete1 = $linkpdo->prepare('SELECT Civilite FROM Usager WHERE Id_Usager = ?');
							$requete1->execute(array($data[0]));	
							$sexe_av;
							while($data1 = $requete1->fetch()){
								$sexe_av=$data1[0];
							}
							if ($sexe_av == "Mr"){
								$sexe_av = "Homme";
							} else if ($sexe_av == "MMe"){
								$sexe_av = "Femme";
							} else {
								$sexe_av = "NS";
							}
							$age=age($data[4]);
							if ($sexe_av=="Homme" &&  $age >  25  && $age < 50){
								$nbH+=1;
							}
							if ($sexe_av=="Femme" && $age > 25 && $age < 50){
								$nbF+=1;
							}
						}
						echo("
					<td>$nbH</td>
					<td>$nbF</td>
							");
					?>
				</tr>
				<tr>
					<td>Plus de 50 ans</td>
					<?php
						$nbH=0;
						$nbF=0;
						$genre="";
						$requete = $linkpdo->prepare('SELECT * FROM Usager');
						$requete->execute();	
						
						while($data = $requete->fetch()){
							$requete1 = $linkpdo->prepare('SELECT Civilite FROM Usager WHERE Id_Usager = ?');
							$requete1->execute(array($data[0]));	
							$sexe_av;
							while($data1 = $requete1->fetch()){
								$sexe_av=$data1[0];
							}
							if ($sexe_av == "Mr"){
								$sexe_av = "Homme";
							} else if ($sexe_av == "MMe"){
								$sexe_av = "Femme";
							} else {
								$sexe_av = "NS";
							}
							$age=age($data[4]);
							if ($sexe_av=="Homme" &&  $age > 50){
								$nbH+=1;
							}
							if ($sexe_av=="Femme" && $age >50){
								$nbF+=1;
							}
						}
						echo("
					<td>$nbH</td>
					<td>$nbF</td>
							");
					?>
				</tr>
			</table>

			<table id="recherche">
				<tr>
					<td><button id="retour" onclick="window.location.href = '../Statistique.php';">Retour</button></td>
				</tr>
			</table>		
        </div>
	</body>
</html>

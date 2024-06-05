<html>
	<head>
		<meta charset="utf-8">
		<title>Accueil | Cabinet médical</title>
		<link rel="stylesheet" href="assets/style.css" />
	</head>

	<body>
		<ul class="Menu">
			<li id="Bouton"><a href="index.php" class="active">Accueil</a></li>
			<li id="Bouton"><a href="pages/Usager.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="pages/Medecin.php">Gérer Médecins</a></li>
			<li id="Bouton"><a href="pages/Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="pages/Statistique.php">Statistiques</a></li>
		</ul>
        
		<!--- Page dynamique --->
		<?php
        require('pages/PHP/db.php');
		$requete = $linkpdo->prepare('SELECT * FROM Authentification WHERE Pseudo = ? AND Mdp = ?');
			$requete->execute(array($_POST["username"], $_POST["password"]));
		if ($requete->rowCount() == 1) {
			//Menu principal
			echo('<ul class="Menu">
					<li id="Bouton"><a href="index.php" class="active">Accueil</a></li>
					<li id="Bouton"><a href="pages/Usager.php">Gérer Usagers</a></li>
					<li id="Bouton"><a href="pages/Medecin.php">Gérer Médecins</a></li>
					<li id="Bouton"><a href="pages/Consultation.php">Gérer Consultations</a></li>
					<li id="Bouton"><a href="pages/Statistique.php">Statistiques</a></li>
					<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
				</ul>');
				//Création du Cookie pour le prénom
				if(!empty($_POST["username"])){
					setcookie("user", $_POST["username"], time() + 60*60);
				}

		} else if (empty($_COOKIE["User"])) {
			//Demande de connexion
			echo('<div id="petite_boite">
            		<form action="index.php" method="POST">
						<h1>Authentification</h1>

						<label><b>Nom d utilisateur</b></label>
                		<input type="text" placeholder="Secretaire" name="username" value="Secretaire" required>

                		<label><b>Mot de passe</b></label>
                		<input type="password" placeholder="MotDePasse" name="password" value="MotDePasse" required><br/>

                		<input type="submit" id="submit" value="CONNEXION">
            		</form>
        		</div>');
		}
		?>
	</body>
</html>

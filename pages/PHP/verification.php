<html>
	<head>
		<meta charset="utf-8" />
		<title>Exercice 10</title>
	</head>

	<body>
		<?php
			//Connexion au serveur MySQL
            require('db.php');
			
			$requete = 'SELECT * FROM Usager';
			if(!$resquery = mysqli_query($link, $requete)) {
				die("Erreur : ".mysqli_errno($link)." : ".mysqli_error($link));
			}
			else {
				while($row = mysqli_fetch_array($resquery, MYSQL_NUM)) {
					echo("Prénom : ".$row[0].", Nom : ".$row[1].", Adresse : ".$row[2].", CP : ".$row[3].", Ville : ".$row[4].", Téléphone : ".$row[5].'<br/>');
				}
			}
		?>
	</body>
</html>

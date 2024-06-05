<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Modifier Médecin | Cabinet Médical</title>
        <link rel="stylesheet" href="../../assets/style.css" />
    </head>
    <body>
        <ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php" class="active">Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		<?php
            // Connexion et sélection de la base
            require('../PHP/db.php');
		?>
		<div id="petite_boite">
			<h1>Editer un médecin</h1>

			<?php
				if(isset($_GET["Nom_Medecin"]) && isset($_GET["Prenom_Medecin"]) && isset($_GET["Civilite_Medecin"])){
					echo('
						<form action="edit_medecin.php" method="POST">
						<input type="hidden" name="Prenom_Medecin_A" value='.$_GET["Prenom_Medecin"].'></input>
   						<input type="hidden" name="Nom_Medecin_A" value='.$_GET['Nom_Medecin'].'></input>
						<input type="hidden" name="Civilite_Medecin_A" value='.$_GET["Civilite_Medecin"].'></input>
							<table id="formulaire">
								<tr>
									<td><label><strong>Civilité</strong></label></td>
									
					');
					$civilite=$_GET["Civilite_Medecin"];
					if($civilite == "MMe"){
						echo('
									<td>
											<select name="Civilite_Medecin_N" required>
												<option value="MMe">Madame</option>
												<option value="">Choisir une civilité</option>
												<option value="Mr">Monsieur</option>
												<option value="NR">Non renseigné</option>
											</select>
									</td>
											
						');
					}
					if($civilite == "Mr"){
						echo('
									<td>
											<select name="Civilite_Medecin_N" required>
												<option value="Mr">Monsieur</option>
												<option value="MMe">Madame</option>
												<option value="">Choisir une civilité</option>
												<option value="NR">Non renseigné</option>
											</select>
									</td>
											
						');
					}
					if($civilite == "NR"){
						echo('
									<td>
											<select name="Civilite_Medecin_N" required>
												<option value="NR">Non renseigné</option>
												<option value="MMe">Madame</option>
												<option value="Mr">Monsieur</option>
											</select>
									</td>
											
						');
					}

					echo('							
									</tr>
									<tr>
										<td><label><strong>Nom</strong></label></td>
										<td><input type="text" value='.$_GET['Nom_Medecin'].' placeholder="Nom du médecin" name="Nom_Medecin_N" required></td>
									</tr>
									<tr>
										<td><label><strong>Prénom</strong></label></td>
										<td><input type="text" placeholder="Prénom du médecin" name="Prenom_Medecin_N" required value='.$_GET["Prenom_Medecin"].' ></td>
									</tr>
									<tr>
										<td colspan="2"><input type="submit"></td>
									</tr>

					');
				}
			?>
							</table>
						</form>
							<td colspan="2"><button onclick="window.location.href = 'rechercher_medecin.php';">Retour</button></td>
        </div>
	</body>
</html>

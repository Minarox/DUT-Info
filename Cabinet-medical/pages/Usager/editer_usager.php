<?php if (empty($_COOKIE["user"]) || !isset($_COOKIE["user"])){header('Location:../../index.php');}?>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Modifier Usager | Cabinet Médical</title>
        <link rel="stylesheet" href="../../assets/style.css" />
    </head>
    <body>
        <ul class="Menu">
			<li id="Bouton"><a href="../../index.php">Accueil</a></li>
			<li id="Bouton"><a href="../Usager.php" class="active">Gérer Usagers</a></li>
			<li id="Bouton"><a href="../Medecin.php" >Gérer Médecins</a></li>
			<li id="Bouton"><a href="../Consultation.php">Gérer Consultations</a></li>
			<li id="Bouton"><a href="../Statistique.php">Statistiques</a></li>
			<li id="Bouton" style="float:right"><a href="#">Déconnexion</a></li>
		</ul>
		<?php
            // Connexion et sélection de la base
            require('../PHP/db.php');
		?>
		<div id="petite_boite">
			<h1>Editer un usager</h1>

			<?php
				if(isset($_GET["Civilite_Usager"]) && isset($_GET["Nom_Usager"]) && isset($_GET["Prenom_Usager"]) && isset($_GET["Date_Naissance_Usager"]) && isset($_GET["Adresse_Usager"]) && isset($_GET["Ville_Usager"]) && isset($_GET["CP_Usager"]) && isset($_GET["Lieu_Naissance_Usager"])){
					echo('
							<form action="edit_usager.php" method="POST">
							<input type="hidden" name="ID_Medecin_A" value='.$_GET["Medecin_T"].'></input>
							<input type="hidden" name="Civilite_Usager_A" value='.$_GET["Civilite_Usager"].'></input>
							<input type="hidden" name="Nom_Usager_A" value='.$_GET["Nom_Usager"].'></input>
							<input type="hidden" name="Prenom_Usager_A" value='.$_GET["Prenom_Usager"].'></input>
							<input type="hidden" name="Adresse_Usager_A" value='.$_GET["Adresse_Usager"].'></input>
							<input type="hidden" name="Ville_Usager_A" value='.$_GET["Ville_Usager"].'></input>
							<input type="hidden" name="CP_Usager_A" value='.$_GET["CP_Usager"].'></input>
							<input type="hidden" name="Date_Naissance_Usager_A" value='.$_GET["Date_Naissance_Usager"].'></input>
							<input type="hidden" name="Lieu_Naissance_Usager_A" value='.$_GET["Lieu_Naissance_Usager"].'></input>
							<input type="hidden" name="Num_Secu_Usager_A" value='.$_GET["Num_Secu_Usager"].'></input>
							<table id="formulaire">
								<tr>
									<td><label><strong>Civilité</strong></label></td>
									
					');

					$civilite=$_GET["Civilite_Usager"];
					if($civilite == "MMe"){
						echo('
									<td>
											<select name="Civilite_Usager_N" required>
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
											<select name="Civilite_Usager_N" required>
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
											<select name="Civilite_Usager_N" required>
												<option value="NR">Non renseigné</option>
												<option value="MMe">Madame</option>
												<option value="Mr">Monsieur</option>
											</select>
									</td>
											
						');
					}

					echo("							
									</tr>
									<tr>
									<td><label><strong>Nom</strong></label></td>
									<td><input type='text' placeholder='Nom de l usager' name='Nom_Usager_N' required value=".$_GET["Nom_Usager"]."></td>
									</tr>
									<tr>
										<td><label><strong>Prénom</strong></label></td>
										<td><input type='text' placeholder='Prénom de l usager' name='Prenom_Usager_N' required value=".$_GET["Prenom_Usager"]."></td>
									</tr>
									<tr>
										<td><label><strong>Adresse</strong></label></td>
										<td><input type='text' placeholder='Adresse de l usager' name='Adresse_Usager_N' required value=".$_GET["Adresse_Usager"]."></td>
									</tr>
									<tr>
										<td><label><strong>Ville</strong></label></td>
										<td><input type='text' placeholder='Ville de l usager' name='Ville_Usager_N' required value=".$_GET["Ville_Usager"]."></td>
									</tr>
									<tr>
										<td><label><strong>Code Postal</strong></label></td>
										<td><input type='number' placeholder='Code postal de la ville de l usager' name='CP_Usager_N' required value=".$_GET["CP_Usager"]."></td>
									</tr>
									<tr>
										<td><label><strong>Date de naissance</strong></label></td>
										<td><input type='date' name='Date_Naissance_Usager_N' required");
										
											$date_A = date('Y-m-d'); 
											$annee_min = intval(date('Y')) - 150 ;
											echo('min= "'.$annee_min . '-' . date('m') . '-' . date('d').'" ');
											echo('max = "'.date('Y-m-d').'" ');
											echo("value=".$_GET["Date_Naissance_Usager"]." ></td>
									</tr>
									<tr>
										<td><label><strong>Lieu de naissance</strong></label></td>
										<td><input type='text' placeholder='Lieu de naissance de l'usager' name='Lieu_Naissance_Usager_N' required value=".$_GET["Lieu_Naissance_Usager"]."> </td>
									</tr>
									<tr>
										<td><label><strong>Numéro Sécurité Sociale</strong></label></td>
										<td><input type='number' placeholder='Numéro de Sécurité Sociale' name='Num_Secu_Usager_N' required value=".$_GET["Num_Secu_Usager"]."></td>
									</tr>
									<tr>
										<td><label><strong>Médecin traitant</strong></label></td>
										<td><input type='text' placeholder='Nom du médecin traitant' name='N_Medecin_Usager_N' value=".$_GET["Medecin_Nom"]."></td>
									</tr>
									<tr>
										<td></td>
										<td><input type='text' placeholder='Prénom du médecin traitant' name='P_Medecin_Usager_N' value=".$_GET["Medecin_Prenom"]."></td>
									</tr>
									<tr>
										<td colspan='2'><input type='submit'></td>
									</tr>

					");
				}
			?>
							</table>
						</form>
							<td colspan="2"><button onclick="window.location.href = 'rechercher_usager.php';">Retour</button></td>
        </div>
	</body>
</html>

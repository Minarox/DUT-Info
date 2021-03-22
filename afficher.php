<!DOCTYPE HTML>
<html>
	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Messagerie instantannée</title>
		<link rel="stylesheet" href="style.css">
	</head>
	
	<body>
		<!-- Cadre générale -->
		<div class=Cadre>
			
		<!-- Cadre informations correspondant -->
		<div class="Correspondant">				
			<table>
				<tr>
					<td><img id="image" src="images/correspondant.png" alt="correspondant"/></td>
					<td width="510"><input id="Auteur" type="text" placeholder="Nom Prénom" value=""></td>
					<td><img id="image" src="images/chevron.png" alt="chevron"></td>
				</tr>
			</table>
		</div>
			
		<!-- Cadre conversation -->
		<div class="Conversation" id="conv">
					
			<table id="liste_message">
				<tr>
					<td id="ls_msg">
						<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
						<script>
							$(document).ready(function(){
								//Première récupération des messages au chargement de la page
								$.ajax({
									url : "recuperer.php",
									type : "GET",

									success : function(recup){
										$("#ls_msg").append(recup);
										tableauId = document.getElementsByClassName("msg");
										//Dernier Id pour comparaison avec les nouveaux messages pour empêcher les doublons
										lastId = document.getElementsByClassName("msg")[tableauId.length-1].id;
										element = document.getElementById("conv");
										element.scrollTop = element.scrollHeight;
									}
								});
								//Routine de raffraichissement pour l'affichage des nouveaux messages
								setInterval(function(){
									$.ajax({
										url : "recuperer.php",
										type : "POST",
										data : {lastId : lastId},
										success : function(recup){
											$("#ls_msg").append(recup);
											tableauId = document.getElementsByClassName("msg");
											lastId = document.getElementsByClassName("msg")[tableauId.length-1].id;
											element = document.getElementById('conv');
											element.scrollTop = element.scrollHeight;
										}
									});
								},2000);
							});
						</script>
					</td>
				</tr>
			</table>	
		</div>
		<!-- Cadre envoie message -->
		<div class="Message">
			<hr>
				<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
				<script type="text/javascript">
				$(document).ready(function() {
					//Envoi en cliquant sur le bouton Envoyer
					$('#Envoyer').click(function() {
						//Vérification que le champ Auteur est bien rempli
						if($("#Auteur").val()==""){
							alert("Veuillez renseigner vos nom et prénom");
						}
						//Vérification que le champ Message est bien rempli
						else if($("#Message").val()==""){
							alert("Vous ne pouvez pas envoyer de message vide");
						}
						//Envoi des données à la BDD
						else {$.ajax({
							url: "enregistrer.php",
							type: "GET",
							data: {Auteur:$("#Auteur").val(), Message:$("#Message").val()},
							
							success: function(requete){
								$("#requete").html(requete);
							}
						})}
						$("#Message").val('');
					});
					//Envoi en appuyant sur Entrée
					$("#Message").keyup(function(objEvent){
						if(objEvent.keyCode == 13){
							$("#Envoyer").click();
						}
					});
				});
				</script>
				<table>
					<tr>
						<td><input id="Message" type="text" placeholder="Ecrivez votre message..." value=""></td>
						<td><input id="Envoyer" type="image" src="images/envoyer.png" value="" alt="envoyer"></td>
					</tr>
				</table>
			</div>
		</div>
	</body>
</html>

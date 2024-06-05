<?php
	date_default_timezone_set("Europe/Paris");
	$msg = $_GET['Message'];
	$auteur = $_GET['Auteur'];
	$date = date('d/m/Y');
	$heure = date('H:i:s');
	try {
	$linkpdo = new PDO("mysql:host={nom_hote};dbname={nom_db}", "{utilisateur}", "{mdp}");	
	}
	catch(Exception $e){
		die('Erreur : '.$e->getMessage());
	}
	$res = $linkpdo->prepare('INSERT INTO chat(Id,Date,Heure,Auteur,Message) VALUES (NULL,:date,:heure,:auteur,:msg)');
	$res->bindParam(':heure', $heure);
	$res->bindParam(':date', $date);
	$res->bindParam(':auteur', $auteur);
	$res->bindParam(':msg', $msg);
	$res->execute();
?>

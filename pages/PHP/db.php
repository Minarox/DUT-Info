<?php
    try {
        $linkpdo = new PDO("mysql:host={host};dbname={database}", "{username}", "{password}");
    }
    catch (Exception $e) {
        die("Erreur : ".$e->getMessage());
    }
?>
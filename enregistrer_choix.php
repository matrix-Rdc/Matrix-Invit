<?php

// Connexion à la base de données
include ("Database/connexion.php");

// Récupération des données envoyées par le script JavaScript
$idPreference = $_POST['id_preference'];
$idUtilisateur = $_POST['id_utilisateur'];

// Préparation de la requête SQL
$req = $cnx_bdd->prepare('INSERT INTO preferences (Id_Utilisateur, Id_Categories_Evenement) VALUES (?, ?)');

// Exécution de la requête SQL
$req->execute(array($idUtilisateur, $idPreference));

// Envoi d'une réponse au script JavaScript
echo "success";

?>

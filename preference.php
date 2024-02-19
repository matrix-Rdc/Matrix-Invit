<?php
session_start();

// Si la session n'existe pas, rediriger vers la page de connexion
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="fr" charset="utf-8">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/event.css">
    <link rel="shortcut icon" type="image/png" href="images/logo.PNG">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Invit-Préférence</title>
</head>
<body>
    
    <div class="preferences text-center d-flex flex-direction-column align-items-center justify-content-center">

        <h2 class="mb-5">Bienvenu(e)! sur Invit <?php echo $_SESSION['user'] ;  ?> <br>Quels genres d'évènements <br> préférez-vous assister ?</h2>

            <div class="choix-pref mb-4">
               <?php

            // Récupération de l'identifiant de l'utilisateur
            $Id_User = $_SESSION['Id_User'];

            // Connexion à la base de données
            include ("Database/connexion.php");

            // Requête pour récupérer les préférences de l'utilisateur
            $req = $cnx_bdd->query('SELECT * FROM categories_evenement');

            // Stockage des résultats de la requête dans un tableau
            $preferences = $req->fetchAll();

    // Initialisation de la variable pour stocker le code HTML des boutons
    $html = '';

    // Déclaration et initialisation du compteur
    $compteur = 0;

        // Parcours des préférences
        foreach ($preferences as $preference) {
                // Création du code HTML du bouton
                $html .= '<button class="pref ms-3 mb-3">' . mb_convert_encoding($preference['Designation_Evenement'], 'UTF-8') . '</button>';
              $compteur++;  // Incrémentation du compteur

                 // Si on a affiché 5 boutons et qu'il reste encore des boutons à afficher
                  if ($compteur % 5 == 0 && $compteur < count($preferences)) {
                      $html .= '<br>';  // Ajout d'un saut de ligne
                 }
                }
        
        // Affichage du code HTML des boutons
        echo $html;
        
        ?>

            </div>
        <div class="w-50">
            <a href="tableau.php"><button class="btnPref">Suivant</a></button>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="javascript/invit.js"></script>
</body>
</html>
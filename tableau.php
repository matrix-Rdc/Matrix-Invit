<?php
    session_start();
    // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
        die();
    } 
    include('config.php');
    $user = $_SESSION['user'] ; 
    $telephone = $_SESSION['telephone'] ;
    $image = $_SESSION['image'] ;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/event.css">
    <link rel="shortcut icon" type="image/png" href="images/logo.PNG">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Mon-tableau-invit</title>
</head>
<body>
    <div class="menu flex items-center justify-between bg-white fixed">
        <a href="tableau.html" class="p-2">
            <h2 class="text-2xl font-bold">Matrix Invit</h2>
        </a>
        <nav class="flex items-center justify-center">
            <ul class="navbar">
                <li class="nav-item p-2">
                    <a href="tableau.html" class="nav-link text-center"><i class="bi bi-house-door"></i><span>Accueil</span></a>
                </li>
                <li class="nav-item p-2">
                    <a href="mesevenements.html" class="nav-link text-center"><i class="bi bi-calendar2-event"></i> <span>Mes évènements</span></a>
                </li>
                <li class="nav-item p-2">
                    <a href="invitations.html" class="nav-link text-center"><i class="bi bi-envelope"></i><span> Invitations</span></a>
                </li>
            </ul>
        </nav>
        <a href="profil.html" class="user flex text-dark items-center p-2">
            <span class="font-semibold"><?php echo $user; ?></span>
            <img class="rounded-full" src="images/home.png" alt="image_user" />
        </a>
    </div>

    <div class="search p-3 fixed bg-white flex items-center justify-center">
        <div class="flex items-center rounded">
            <input type="search" placeholder="Rechercher un évènement" /><i class="bi bi-search text-2xl cursor-pointer"></i>
        </div>
    </div>

    <div class="accueil absolute bg-white flex flex-col p-3 mb-4">

       <h2 class="mb-4 font-bold">Evènements populaires 🔥</h2>

               <?php
// Récupérer les événements
  $req = $bdd->query('SELECT * FROM evenements');
  while ($event = $req->fetch()) {
    // Afficher l'événement
    echo '<div class="evenements flex flex-col mb-5">';
    echo '<img src="' . $event['Affiche'] . '" alt="" class="rounded w-100 mb-2">';
    echo '<h2 class="font-bold mb-3 text-2xl">' . $event['Titre'] . '</h2>';
    echo '<p class="mb-2"><span><ii class="bi bi-calendar"></ii></span> ' . $event['Date_Event'] . ' - ' . $event['Heure'] . '</p>';
    echo '<p class="font-bold mb-3"><i class="bi bi-geo-alt-fill"></i> ' . $event['Lieu'] . '</p>';
    echo '<p class="mb-2"><i class="bi bi-geo-alt"></i> ' . $event['Adresse'] . '</p>';


    echo '<div class="avis flex items-center justify-between text-center">';
    echo '<div onclick="userInteresse()" class="interesse flex items-center rounded cursor-pointer">';
    echo '<p class="w-100 p-2 font-bold"><span class="ctr"></span> Interessé <span><i class="heart bi bi-heart"></i></span></p>';
    echo '</div>';
    echo '<div class="participe p-2">';
    echo '<button onclick="participeEvent()" class="rounded text-white font-semibold w-100">Participer</button>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
}

// Fermer la connexion
$bdd = null;
?>


        <h2 class="mb-4 font-bold">Sponsorisés <i class="bi bi-emoji-heart-eyes-fill"></i></h2>

        <div class="evenements flex flex-col mb-5">
            <img src="images/conf.jpeg" alt="" class="rounded w-100 mb-2">
            <h2 class="font-bold mb-3 text-2xl">Conférence National</h2>
            
            <p class="mb-2"><span><ii class="bi bi-calendar"></ii></span> Mercredi 22 Mars - 19h00</p>
            <p class="font-bold mb-3"><i class="bi bi-geo-alt-fill"></i> Musé National Kinshasa/Lingwala</p>

            <div class="avis flex items-center justify-between text-center">
                <div onclick="userInteresse()" class="interesse flex items-center rounded cursor-pointer">
                    <p class="w-100 p-2 font-bold"><span class="ctr"></span> Interessé <span><i class="heart bi bi-heart"></i></span></p>
                </div>
                <div class="participe p-2">
                    <button class="rounded text-white font-semibold w-100">Participer</button>
                </div>
            </div>
        </div>

        <div class="evenements flex flex-col mb-5">
            <img src="images/match.jpeg" alt="" class="rounded w-100 mb-2">
            <h2 class="font-bold mb-3 text-2xl">Match Amical RDC vs Angola</h2>
            
            <p class="mb-2"><span><ii class="bi bi-calendar"></ii></span> Jeudi 14 Février - 20h00</p>
            <p class="font-bold mb-3"><i class="bi bi-geo-alt-fill"></i> SDM Kinshasa/Kinshasa</p>

            <div class="avis flex items-center justify-between text-center">
                <div onclick="userInteresse()" class="interesse flex items-center rounded cursor-pointer">
                    <p class="w-100 p-2 font-bold"><span class="ctr"></span> Interessé <span><i class="heart bi bi-heart"></i></span></p>
                </div>
                <div class="participe p-2">
                    <button class="rounded text-white font-semibold w-100">Participer</button>
                </div>
            </div>
        </div>

    </div>

    <div class="profil fixed bg-white flex-col">
         <?php
// Définir une variable pour stocker le message d'erreur
$errorMessage = "";

// Tester si la variable de session 'image' existe
if (!isset($_SESSION['image'])) {
  // Afficher un message d'erreur si la variable n'existe pas
  $errorMessage = "L'image n'est pas définie dans la session.";
} else {
  // Tester si la valeur de la variable 'image' est vide
  if (empty($_SESSION['image'])) {
    // Afficher un message d'erreur si la valeur est vide
    $errorMessage = "L'image est vide.";
  } else {
    // **Obtenir le chemin d'accès absolu du fichier image**
    $image = $_SESSION['image'];

    // Tester si le fichier image existe
    if (!file_exists($image)) {
      // Afficher un message d'erreur si le fichier n'existe pas
      $errorMessage = "Le fichier image n'existe pas.";
    } else {
      // Définir la largeur et la hauteur de l'image
      $width = 200; // Remplacer par la largeur souhaitée
      $height = 300; // Remplacer par la hauteur souhaitée

      // Calculer la taille maximale en fonction de la largeur et de la hauteur
      $maxSize = max($width, $height);

      // Définir les marges de l'image
      $marginTop = 10; // Remplacer par la marge souhaitée en haut
      $marginRight = 15; // Remplacer par la marge souhaitée à droite
      $marginBottom = 20; // Remplacer par la marge souhaitée en bas
      $marginLeft = 25; // Remplacer par la marge souhaitée à gauche

      // Générer le code HTML pour l'image
      echo '<img src="' . $image . '" class="img-fluid img-thumbnail" style="width: ' . $maxSize . 'px; height: ' . $maxSize . 'px; margin-top: ' . $marginTop . 'px; margin-right: ' . $marginRight . 'px; margin-bottom: ' . $marginBottom . 'px; margin-left: ' . $marginLeft . 'px;">';
    }
  }
}

// Afficher le message d'erreur s'il y en a un
if (!empty($errorMessage)) {
  echo '<p class="text-danger">' . $errorMessage . '</p>';
}
?>


        <div class="information p-3 w-100 mb-3">
            <p class="font-bold md:text-2xl"><?php echo $user ;  ?></p>
            <p class="font-semibold mb-4">+243 <?php echo $telephone; ?></p>
            <h2 class="font-semibold mb-3">
                Mes Préférences
            </h2>
            <div class="row gap-3 mb-2 text-center p-3">
                <div class="prefer col font-semibold p-2 rounded">
                    Match
                </div>
                <div class="prefer col font-semibold p-2 rounded">
                    Conférence
                </div>
                <div class="prefer col font-semibold p-2 rounded">
                    Concert
                </div>
                <div class="prefer col font-semibold p-2 rounded">
                    Rétraite
                </div>
                <div class="prefer col font-semibold p-2 rounded">
                    Cours
                </div>
            </div>
            <button class="w-100 font-semibold text-white rounded">Modifier les informations</button>
        </div>
    </div>

    <div class="infos fixed rounded bg-white p-2">
        
        <h2 class="font-semibold text-2xl mb-4">Mes évènements</h2>
        <div class="evenement items-center w-100 mb-3">
            <img class="rounded col" src="images/prieres.jpg" alt="">
            <div class="infos-events mb-2 col p-3">
                <h5 class="font-semibold text-2xl mb-3">Retraite de Prière</h5>
                <hr class="col-md-8 mb-4">
                <p class="mb-2"><span><i class="bi bi-person-fill"></i></span> 500 invitations envoyées</p>
                <p class="mb-2"><span style="color: #FA6E61;"><i class="bi bi-heart-fill"></i></span> 6532 Interéssés</p>
                <p class="mb-2"><span><i class="bi bi-calendar-fill"></i></span> Vendredi 25 Avril - 19h00</p>
                <p class="mb-2"><span><i class="bi bi-geo-alt-fill"></i> Eglise la compation</span></p>
            </div>
        </div>
        <div class="flex items-center justify-between mb-3 w-full">
            <button class="ajouter rounded font-semibold"><span><i class="bi bi-send"></i></span> Envoyer Invitation</button>
            <button class="mod rounded text-white font-semibold"><span><i class="bi bi-pencil-fill"></i></span> Modifier</button>
        </div>
        <button class="newEvenr font-semibold flex items-center"><span><i class="bi bi-plus text-2xl"></i></span> Nouvel Evènement</button>
    </div>

    <div onclick="participeEvent()" class="overMod fixed"></div>

    <div class="participer p-5 fixed">

        <h1 class="text-2xl font-semibold mb-5">Participer à l'évènement</h1>

        <div class="text-center mb-5">

            <p class="text-2xl mb-3"> Pour participer à cet évènement vous devez acheter votre billet</p>

            <button class="text-white font-semibold p-3 rounded">Acheter le billet</button>

        </div>

    </div>

       
    <a href="event.php"><button id="btnCreatEvent" class="fixed font-bold"><i class="bi bi-plus text-5xl text-white"></i></button></a>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="javascript/invit.js"></script>
</body>
</html>
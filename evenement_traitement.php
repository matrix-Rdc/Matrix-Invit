<?php
session_start();

// Si la session n'existe pas ou si l'on n'est pas connecté, on redirige
if (!isset($_SESSION['user'])) {
  header('Location: login.php');
  die();
}

include('config.php');

$Id_User = $_SESSION['Id_User'];

?>

<?php
require_once 'config.php';

// Si les variables existent et qu'elles ne sont pas vides
if (!empty($_POST['Titre']) && !empty($_POST['selecttype']) && !empty($_POST['date']) && !empty($_POST['heure']) && !empty($_POST['mode']) && !empty($_POST['lieuEvent']) && !empty($_POST['AdresseEvent'])) {

  // Sécurisation contre les injections XSS
  $Titre = htmlspecialchars($_POST['Titre']);
  $selecttype = htmlspecialchars($_POST['selecttype']);
  $date_event = htmlspecialchars($_POST['date']);
  $heure = htmlspecialchars($_POST['heure']);
  $mode = htmlspecialchars($_POST['mode']);
  $lieuEvent = htmlspecialchars($_POST['lieuEvent']);
  $AdresseEvent = htmlspecialchars($_POST['AdresseEvent']);
  $visibilite = htmlspecialchars($_POST['visibilite']);

  // Traitement du champ image
  if ($_FILES['image']['error'] == UPLOAD_ERR_OK) {

    // Génération d'un nom unique pour l'image
    $nom_image = uniqid() . '.' . basename($_FILES['image']['name']);

    // Déplacement de l'image vers le dossier de destination
    move_uploaded_file($_FILES['image']['tmp_name'], 'images/' . $nom_image);

    // Enregistrement du chemin de l'image dans la base de données
    $image = 'images/' . $nom_image;
  } else {
    $image = '';
  }

  // Insertion dans la base de données
  $insert = $bdd->prepare('INSERT INTO evenements (Titre, Date_Event, Lieu, Affiche, Adresse, Heure, Id_Categories_Evenement, Type_Evenement, mode, Id_User) VALUES(:Titre, :date_event, :lieuEvent, :image, :AdresseEvent, :heure, :selecttype, :visibilite,:mode, :Id_User)');
  $insert->execute(array(
    'Titre' => $Titre,
    'selecttype' => $selecttype,
    'date_event' => $date_event,
    'heure' => $heure,
    'mode' => $mode,
    'heure' => $heure, // Correction : doublon de la variable $heure
    'AdresseEvent' => $AdresseEvent,
    'visibilite' => $visibilite, // Correction : définition de la variable avant utilisation
    'Id_User' => $Id_User,
    'image' => $image,
    'lieuEvent' => $lieuEvent,
  ));

  // En cas de succès, on redirige vers la page d'accueil avec le message de succès
  if ($insert->rowCount() > 0) {
  header('Location: event.php?reg_err=succes');
  die();
} else {
  // En cas d'erreur, on redirige vers la page d'inscription avec le message d'erreur
  header('Location: event.php?reg_err=erreur');
  die();}
}
?>


<?php
require_once 'config.php'; // On inclut la connexion à la bdd
// Si les variables existent et qu'elles ne sont pas vides
if(!empty($_POST['username']) && !empty($_POST['telephone']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
{
// Patch XSS

$username = htmlspecialchars($_POST['username']);
$telephone = htmlspecialchars($_POST['telephone']);
$password = htmlspecialchars($_POST['password']);
$password_retype = htmlspecialchars($_POST['password_retype']);
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
// On vérifie si l'utilisateur existe
$check = $bdd->prepare('SELECT username, telephone, password FROM utilisateurs WHERE telephone = ?');
$check->execute(array($telephone));
$data = $check->fetch();
$row = $check->rowCount();

// Si la requête renvoie un 0 alors l'utilisateur n'existe pas
if($row == 0){
if(strlen($username) <= 20){ // On vérifie que la longueur du pseudo <= 20
if($password === $password_retype){

// On hash le mot de passe avec Bcrypt, via un coût de 12
$cost = ['cost' => 12];
$password = password_hash($password, PASSWORD_BCRYPT, $cost);
// On stock l'adresse IP
$ip = $_SERVER['REMOTE_ADDR']; 

// On insère dans la base de données
$insert = $bdd->prepare('INSERT INTO utilisateurs (username, telephone, password, image, ip) VALUES(:username, :telephone, :password, :image, :ip)');
$insert->execute(array(
'username' => $username,
'telephone' => $telephone, // On ajoute la variable pour le téléphone
'password' => $password,
'image' => $image,
'ip' => $ip
));

// Si l'insertion a réussi, on redirige vers la page d'inscription avec le message de succès
if($insert->rowCount() > 0){
header('Location: inscription.php?reg_err=success');
die();
}else{
// Affichage d'un message d'erreur
echo "Une erreur est survenue lors de l'inscription.";
}
}else{ header('Location: inscription.php?reg_err=password'); die();}
}else{ header('Location: inscription.php?reg_err=pseudo_length'); die();}
}else{ header('Location: inscription.php?reg_err=already'); die();}
}

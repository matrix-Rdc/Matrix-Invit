<?php 
    session_start(); // Démarrage de la session
    require_once 'config.php'; // On inclut la connexion à la base de données

    if(!empty($_POST['telephone']) && !empty($_POST['password'])) // Si il existe les champs telephone, password et qu'il sont pas vident
    {
        // Patch XSS
        $telephone = htmlspecialchars($_POST['telephone']); 
        $password = htmlspecialchars($_POST['password']);
      
        // On regarde si l'utilisateur est inscrit dans la table utilisateurs
        $check = $bdd->prepare('SELECT Id_User,username, telephone, password, image FROM utilisateurs WHERE telephone = ?');
        $check->execute(array($telephone));
        $data = $check->fetch();
        $row = $check->rowCount();
        
        // Si > à 0 alors l'utilisateur existe
        if($row > 0)
            {
             if(password_verify($password, $data['password']))
             {
            $_SESSION['Id_User'] = $data['Id_User'];
            $_SESSION['user'] = $data['username'];
            $_SESSION['telephone'] = $data['telephone'];
            $_SESSION['image'] = $data['image'];
             // **Ajout d'un écho pour vérifier la valeur de $_SESSION['image']**
             echo 'Valeur de $_SESSION[\'image\']: ' . $_SESSION['image'] . '<br>';
             // **Vérification de la valeur de $_SESSION['image']**
             if (!empty($_SESSION['image']) && file_exists($_SESSION['image'])) {
                 header('Location:preference.php');
                 die();
             } else {
                 echo '<p class="text-danger">L\'image n\'est pas définie ou n\'existe pas.</p>';
             }
            }
            else {
                header('Location: ../login.php?login_err=password'); die();
            }
        }
        else {
            header('Location: ../login.php?login_err=already'); die();
        }
            }

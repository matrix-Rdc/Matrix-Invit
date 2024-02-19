<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/event.css">
    <link rel="shortcut icon" type="image/png" href="images/logo.PNG">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title><?= $APP_NAME; ?> - inscription</title>
</head>
<body>
    
    <div class="container d-flex align-items-center justify-content-center w-100">
        <div class="form-ins">
            <?php 
                if(isset($_GET['reg_err']))
                {
                    $err = htmlspecialchars($_GET['reg_err']);

                    switch($err)
                    {
                        case 'success':
                        ?>
                            <div class="alert alert-success">
                                <strong>Succès</strong> inscription réussie !
                            </div>
                        <?php
                        break;

                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe différent
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email non valide
                            </div>
                        <?php
                        break;

                        case 'email_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email trop long
                            </div>
                        <?php 
                        break;

                        case 'pseudo_length':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> pseudo trop long
                            </div>
                        <?php 
                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte deja existant
                            </div>
                        <?php 

                    }
                }
                ?>
        <form class="text-center" action="inscription_traitement.php" method="post" enctype="multipart/form-data">
               <h2 class="mb-4">Créer un compte invit</h2>
               <img class="mb-2" src="images/users.png" alt="logo/invit" id="img-change"><br>
               <input type="file" id="upload-img" name="image" accept="image/*">
               <label for="upload-img" class="mb-4 rounded cursor-pointer">Choisir une photo <i class="bi bi-camera-fill"></i></label>

              <div class="champs mb-3 d-flex align-items-center justify-content-center">
                  <span><i class="bi bi-person"></i></span>
                  <input type="text" placeholder="Nom Utilisateur" name="username" id="username" required>
              </div>
             <div class="champs mb-3 d-flex align-items-center justify-content-center">
                 <span>+243</span>
                    <input type="number" placeholder="Téléphone" name="telephone" id="telephone" required>
             </div>
             <div class="champs mb-3 d-flex align-items-center justify-content-center">
                <span><i id="oeil" onclick="changeView()" class="bi bi-eye-slash-fill"></i></span>
                 <input type="password" placeholder="Mot de passe" name="password" id="password" class="inputPass" required>
                </div>
             <div class="champs mb-4 d-flex align-items-center justify-content-center">
                 <span><i id="oeil" onclick="changeView()" class="bi bi-eye-slash-fill"></i></span>
                 <input type="password" placeholder="Confirmer Le Mot de passe" name="password_retype" id="password_retype" class="inputPass" required>
            </div>

            <button type="submit" class="font-semibold col-md-12 mb-2">
                    S'inscrire
            </button>
            <p>Avez-vous déjà un compte ? <a href="login.php" style="color: #FA6E61;">se connecter</a></p>
        </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="javascript/invit.js"></script>
</body>
</html>
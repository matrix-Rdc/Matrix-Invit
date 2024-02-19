<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/event.css">
    <link rel="shortcut icon" type="image/png" href="images/logo.PNG">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Invit-connexion</title>
</head>
<body>
    <div class="container d-flex align-items-center justify-content-center w-100">
        <div class="form-conn">
            <div class="login-form">
             <?php 
                if(isset($_GET['login_err']))
                {
                    $err = htmlspecialchars($_GET['login_err']);

                    switch($err)
                    {
                        case 'password':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> mot de passe incorrect
                            </div>
                        <?php
                        break;

                        case 'email':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> email incorrect
                            </div>
                        <?php
                        break;

                        case 'already':
                        ?>
                            <div class="alert alert-danger">
                                <strong>Erreur</strong> compte non existant
                            </div>
                        <?php
                        break;
                    }
                }
                ?> 
            <?php // Nous soumetons les informations à la page Connexion.php
             ?>
            <form class="rounded" action="connexion.php" method="post">

                <img src="images/logo.PNG" alt="logo/invit">

                <h2 class="mb-3">S'Identifier</h2>
                <p class="mb-4">Lorem ipsum dolor sit amet consectetur.</p>

                <div class="text-center d-flex align-items-center justify-content-center champs mb-4">
                    <span>+243</span>
                    <input type="tel" placeholder="Téléphone" name="telephone" required>
                </div>
                <div class="text-center d-flex align-items-center justify-content-center champs mb-4">
                    <span><i id="oeil" onclick="changeView()" class="bi bi-eye-slash-fill"></i></span>
                    <input type="password" placeholder="Mot de passe" name="password" class="inputPass" required>
                </div>

                <p class="mb-3"><a href="#" style="color: #FA6E61;" >Mot de passe oublié ?</a></p>

                <button type="submit" class="col-md-12 mb-2">
                    Se connecter
                </button>
                <p>Vous n'avez pas de compte ? <a href="inscription.php" style="color: #FA6E61;">créer un compte</a></p>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="javascript/invit.js"></script>
</body>
</html>
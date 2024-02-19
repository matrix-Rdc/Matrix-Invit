<?php
    session_start();
    // si la session existe pas soit si l'on est pas connecté on redirige
    if(!isset($_SESSION['user'])){
        header('Location:login.php');
        die();
    } 
   
    include('config.php');
    $sql = "SELECT * FROM categories_evenement";
    $stmt = $bdd->query($sql);
    $liste_categories_evenement = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $user = $_SESSION['user'] ; 
    $telephone = $_SESSION['telephone'] ;
    $image = $_SESSION['image'] ;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/event.css">
    <link rel="shortcut icon" type="image/png" href="images/logo.PNG">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
    <title>Créer un évènement</title>
</head>
<body>

    <div class="container d-flex align-items-center justify-content-center w-100">

        <div class="form-event">
            <form class="rounded" action="evenement_traitement.php" method="post" enctype="multipart/form-data">
                <?php
                    // Définir une valeur par défaut pour $message
                    $message = isset($_GET['reg_err']) ? $_GET['reg_err'] : '';

                    // Affichage du message
                    if ($message === 'succes') {
                        echo '<div class="alert alert-success">L\'évènement a été créé avec succès !</div>';
                    } elseif ($message === 'erreur') {
                        echo '<div class="alert alert-danger">Une erreur est survenue lors de la création de l\'évènement.</div>';
                    }
                    ?>

                <h1 class="mb-2 font-bold text-3xl"><i class="bi bi-plus-circle"></i> Ajouter un évènement</h1>
                <h2 class="mb-5">Créer un évènemet de votre choix, et invité des personnes qui vous sont chèrs !</h2>

                <div class="relative d-flex champsEvent mb-3">
                    <input placeholder="Titre de l'évènement" class="absolute placeHol" type="text" name="Titre" required>
                </div>

                <div class="relative d-flex champsEvent mb-3">
                <input type="file" name="image" id="image" style="padding-top: 1%" class="absolute placeHol" required>
                <label for="image" class="input-file-trigger">
                  <span>Affiche de l’évènement</span>
                </label>
                </div>
                <div class="relative d-flex champsEvent mb-3">
                    <select name="selecttype" id="" class="form-control">
                       <?php foreach ($liste_categories_evenement as $categories_evenement) : ?>
                        <option value="<?php echo $categories_evenement['Id_Categories_Evenement']; ?>"><?php echo $categories_evenement['Designation_Evenement']; ?></option>
                    <?php endforeach; ?>
                    </select>
                </div>

                <h3 class="mb-3 text-2xl font-semibold">Lieu et Date</h3>

                <div class="flex items-center dateHeure mb-3">
                    <div class="date">
                        <label class="font-semibold" for="date">Date :</label><br>
                        <input type="date" class="form-control" required name="date">
                    </div>
                    <div class="Heure">
                        <label class="font-semibold" for="date">Heure :</label><br>
                        <input type="time" class="form-control" required name="heure">
                    </div>
                </div> 
                <div class="d-flex champsEvent mb-3">
                    <select name="mode" id="selectmode" onchange="selectMode()" class="form-control">
                        <option value="presence">En presentiel</option>
                        <option value="ligne">En ligne</option>
                    </select>
                </div>

                <div class="relative d-flex champsEvent mb-3">
                    <span class="absolute place zoneLieu">Lieu de l'évènement</span>
                    <input onfocus="overFocus()" onblur="overBlur()" class="absolute zone" type="text" name="lieuEvent" required>
                </div>

                <div class="relative d-flex champsEvent mb-5">
                    <input class="absolute zone" type="text" name="AdresseEvent" placeholder="Adresse de l'évènement" required>
                </div>
       
                <h3 class="mb-3 text-2xl font-semibold">Autres Informations</h3>

                <h4 class="mb-3"><span class="font-semibold">Définissez la visibilité de votre évènement !</span> <br> Un évènement privé ne sera vu que par les personnes que vous aurez invitées. <br> Contrairement à un évènement publique qui sera vu par tout le monde, <br> et tout le monde pourra y partiiper.</h4>

                <div class="mb-4 row">
                    <div class="priv col flex items-center">
                        <input type="radio" name="visibilite" id="prive" value="1" required><label for="prive" class=""> Privé</label>
                    </div>
                    <div class="pub col flex items-center">
                        <input type="radio" name="visibilite" id="public" value="2" required><label for="public" class=""> Publique</label>
                    </div>
                </div>

                <div class="flex justify-between w-100">
                    <button type="reset" class="annuler font-semibold">Annuler <i class="bi bi-x-circle"></i></button>
                    <button type="submit" class="ajouter font-semibold">Ajouter <i class="bi bi-plus-circle"></i></button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="javascript/invit.js"></script>   
</body>
</html>
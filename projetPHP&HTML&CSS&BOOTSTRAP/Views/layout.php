<!DOCTYPE html>
<html lang="fr">
    <head>
        <title><?= $title ?></title>
        <link href="../boot.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <meta charset="utf-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    </head>
    <body>
        <nav class="navbar navbar-dark bg-dark">
            <a class="navbar-brand" href="index.php?controller=filmController&action=tabfilm&type=default">Home</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsnav" aria-controls="collapsnav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsnav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link active" href="index.php?controller=filmController&action=tabfilm&type=default">Films</a></li>
                    <li class="nav-item"><a class="nav-link active" href="index.php?controller=acteurController&action=tabacteur&type=default">Acteurs</a></li>
                    <li class="nav-item"><a class="nav-link active" href="index.php?controller=castingController&action=tabcasting&type=default">Casting</a></li>
                    <?php     
                    if(isset($_SESSION["id"])){
                    ?>
                        <li style="float:right" class="nav-item"><a class="nav-link active" href="index.php?controller=userController&action=profil">Mon profil</a></li>
                        <li style="float:right" class="nav-item"><a class="nav-link active" href="index.php?controller=userController&action=deconnexion">Se déconnecter</a></li>
                    <?php 
                    } else {
                    ?>
                        <li class="nav-item"><a class="nav-link active" href="index.php?controller=userController&action=seconnecter">Se connecter</a></li>
                        <li class="nav-item"><a class="nav-link active" href="index.php?controller=userController&action=sinscrire">S'inscrire</a></li>
                    <?php 
                    }
                    ?>      
                </ul>
            </div>
        </nav>
        <?php
        if(isset($msg)){
            echo $msg;
        }
        ?>
        <?= $content ?>
    </body>
</html>
<?php 
$title = "Ma médiathèque de films";
?>
<?php ob_start(); ?>

<div class="container-fluid rg">
    <div class="row">
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <form action="index.php?controller=userController&action=connexion" method="post" class="form-container">
            <h2>Connexion</h2>
            <label class="form-label">Identifiant</label></br>
            <input type="text" placeholder="Pseudo ou adresse mail" name="loginmail" class="form-control form-control-sm">
            <hr style="visibility:hidden;">
            <label class="form-label">Mot de passe</label></br>
            <input type="password" placeholder="Mot de passe" name="pwd" class="form-control form-control-sm"/>
            <hr style="visibility:hidden;"></br>
            <input type="submit" value="Valider" name="valid" class="btn btn-dark">
            </form>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12"></div>
    </div>
</div>

<?php $content = ob_get_clean(); ?>

<?php require_once("layout.php") ?>

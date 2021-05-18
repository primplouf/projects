<?php 
$title = "Ma médiathèque de films";
?>
<?php ob_start(); ?>
<div class="container-fluid">
<?php
if ((isset($_SESSION))==False)
{
    session_start();
}
echo "<h1>Bienvenue dans votre espace utilisateur ".$_SESSION["login"]."</h1>";
echo "<h4>Vos informations</h4>";
echo "Numéro d'dentifiant : ".$_SESSION["id"]."</br>";
echo "Pseudo : ".$_SESSION["login"]."</br>";
echo "Adresse mail : ".$_SESSION["email"]."</br>";
?>
</div>
<?php $content = ob_get_clean(); ?>

<?php require_once("layout.php") ?>

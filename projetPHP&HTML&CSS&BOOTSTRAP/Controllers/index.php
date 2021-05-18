<?php
session_start();
if(isset($_GET["controller"])){
    $controller = $_GET["controller"];
    $action = $_GET["action"];
} else {
    $controller = "";
    $action = "";
}

require_once("filmController.php");
require_once("acteurController.php");
require_once("userController.php");
require_once("castingController.php");
require_once("voteController.php");

switch($controller){
    case "filmController" : $fc = new filmController();
    switch($action){
        case "add" : $fc->addF(); break;
        case "update" : $fc->updateF($_GET["id"]); break;
        case "delete" : $fc->deleteF($_GET["id"]); break;
        case "tabfilm" : if(isset($_GET["id"])){ $fc->afficheF($_GET["type"], $_GET["id"]); }else{ $fc->afficheF($_GET["type"]); }; break;
        case "detailFilm" : $fc->detailsF($_GET["id"], $_GET["type"]); break;
    }
    break;
    case "acteurController" : $ac = new acteurController();
    switch($action){
        case "add" : $ac->addA(); break;
        case "update" : $ac->updateA($_GET["id"]); break;
        case "delete" : $ac->deleteA($_GET["id"]); break;
        case "tabacteur" : if(isset($_GET["id"])){ $ac->afficheA($_GET["type"], $_GET["id"]); }else{ $ac->afficheA($_GET["type"]); }; break;
    }
    break;
    case "userController" : $uc = new userController();
    switch($action){
        case "inscription" : $uc->addU(); break;
        case "connexion" : $uc->connexion(); break;
        case "deconnexion" : $uc->deconnexion(); break;
        case "profil" : $uc->afficheP(); break;
        case "sinscrire" : $uc->afficheI(); break;
        case "seconnecter" : $uc->afficheC(); break;
    }
    break;
    case "castingController" : $cc = new castingController();
    switch($action){
        case "add" : $cc->addC(); break;
        case "delete" : $cc->deleteC($_GET["id_film"], $_GET["id_acteur"]); break;
        case "tabcasting" : $cc->afficheC($_GET["type"]); break;
    }
    break;
    case "voteController" : $cc = new voteController();
    switch($action){
        case "update" : $cc->updateV($_GET["film_id"], $_GET["user_id"]); break;
    }
    break;
    default : $fc = new filmController(); $fc->afficheF("default"); break;
}
?>
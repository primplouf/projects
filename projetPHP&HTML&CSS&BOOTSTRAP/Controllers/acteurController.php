<?php

require_once("../Models/Acteur.class.php");
require_once("../Models/Film.class.php");
require_once("../Models/ActeurManager.php");
require_once("../Models/FilmManager.php");
require_once("../Models/Database.class.php");

class acteurController {

    private $ActeurManager;
    private $bdd;

    public function __construct(){
        $bd = new database();
        $this->bdd = $bd->connectDb();
        $this->ActeurManager = new ActeurManager($this->bdd);
    }

    public function addA(){
        if (isset($_POST["nom"])){
            $prenom = htmlspecialchars($_POST["prenom"]);
            $nom = htmlspecialchars($_POST["nom"]);
            $a = array("prenom" => "$prenom", "nom" => "$nom");
            $acteur = new Acteur($a);
            if ($this->ActeurManager->addActeur($acteur)){
                $msg = "Acteur ajouté";
            } else {
                $msg = "L'acteur n'a pas été ajouté";
            }
            $type = "default";
        } else {
            $type = "add";
        }
        
        Header("location: index.php?controller=acteurController&action=tabacteur&type=$type");
    }

    public function updateA($id){
        if (isset($_POST["prenom"])){
            $acteur = $this->ActeurManager->getById($id);
            if($_POST["prenom"]!=""){
                $acteur->setPrenom(htmlspecialchars($_POST["prenom"]));
            }
            if($_POST["nom"]==""){
                $acteur->setNom(htmlspecialchars($_POST["nom"]));
            } 
            if ($this->ActeurManager->updateActeur($acteur)){
                $msg = "Acteur modifié";
            } else {
                $msg = "L'acteur n'a pas été modifié";
            }
            $type = "default";
        } else {
            $type = "update";
        }
        Header("location: index.php?controller=acteurController&action=tabacteur&type=$type&id=$id");
    }

    public function deleteA($id){
        $a = array("id" => "$id");
        $acteur = new Acteur($a);
        if ($this->ActeurManager->deleteActeur($acteur)){
            $CastingManager = new CastingManager($this->bdd);
            $castings = $CastingManager->getByIdA($id);
            foreach($castings as $casting){
                $CastingManager->deleteCasting($casting);
            }
            $msg = "Acteur supprimé";
        } else {
            $msg = "L'acteur n'a pas été supprimé";
        }
        $type = "default";
        Header("location: index.php?controller=acteurController&action=tabacteur&type=$type");
    }

    public function getAllA(){
        $acteurs = $this->ActeurManager->getList();
        return $acteurs;
    }

    public function getActorsInF(Film $film){
        $acteurs = $this->ActeurManager->getActorsInFilm($film);
        return $acteurs;
    }

    public function afficheA($type, $id=0){
        $acteurs = $this->ActeurManager->getList();
        $FilmManager = new FilmManager($this->bdd);
        $filmsWithActors = array();
        foreach($acteurs as $acteur){
            $films = $FilmManager->getFilmsWithActor($acteur);
            $filmsWithActors[$acteur->id()]['acteur'] = $acteur;
            $filmsWithActors[$acteur->id()]['films'] = $films;
        }
        if (!isset($type)){
            $type = "default";
        }
        if ($id!=0){
            $acteur = $this->ActeurManager->getById($id);
        }
        include("../Views/acteur.php");
    }
}

?>
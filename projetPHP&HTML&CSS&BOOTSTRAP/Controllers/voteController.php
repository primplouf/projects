<?php 

require_once("../Models/Database.class.php");
require_once("../Models/FilmManager.php");
require_once("../Models/Film.class.php");
require_once("../Models/VoteManager.php");
require_once("../Models/Vote.class.php");

class voteController {
    private $VoteManager;
    private $bdd;

    public function __construct(){
        $bd = new database();
        $this->bdd = $bd->connectDb();
        $this->VoteManager = new VoteManager($this->bdd);
    }

    function updateV($id_film, $id_user){
        if(isset($_POST["note"])){
            $vote = $this->VoteManager->getByIds($id_film, $id_user);
            $FilmManager = new FilmManager($this->bdd);
            if ($vote[1]=="add") {
                if($_POST["note"]!=""){
                    $vote[0]->setNote(htmlspecialchars($_POST["note"]));
                }
                if ($this->VoteManager->addVote($vote[0])){
                    $msg = "vote ajouté";
                    $film = $FilmManager->getById($id_film);
                    $film->setNb_vote($film->vote()+1);
                    $film->setScore($film->score()+$vote[0]->note());
                    $FilmManager->updateFilm($film);
                } else {
                    $msg = "Le vote n'a pas été ajouté";
                }
            } else if ($vote[1]=="update") {
                $note = $vote[0]->note();
                if($_POST["note"]!=""){
                    $vote[0]->setNote(htmlspecialchars($_POST["note"]));
                }
                if ($this->VoteManager->updateVote($vote[0])){
                    $msg = "vote modifié";
                    $film = $FilmManager->getById($id_film);
                    $film->setScore($film->score()+$vote[0]->note()-$note);
                    $FilmManager->updateFilm($film);
                } else {
                    $msg = "Le vote n'a pas été modifié";
                }
            }
            $type = "default";
        } else {
            $type = "update";
        }
        header("location: index.php?controller=filmController&action=detailFilm&id=$id_film&type=$type");   
     }
}
?>
<?php

require_once("Casting.class.php");
require_once("Film.class.php");
require_once("Acteur.class.php");

class CastingManager {

    private $_db;

    public function __construct($db){
        $this->_db = $db;
    }

    public function addCasting(Casting $casting)
    {
        $q = $this->_db->prepare("INSERT INTO casting(film_id, acteur_id) VALUES(:film_id, :acteur_id)");
  
        $q->bindValue(':film_id', $casting->film_id());
        $q->bindValue(':acteur_id', $casting->acteur_id());
        
        return $q->execute();
    }

    public function updateCasting(Casting $casting)
    {
        $q = $this->_db->prepare("UPDATE casting SET film_id=:film_id AND acteur_id=:acteur_id");
  
        $q->bindValue(':film_id', $casting->film_id());
        $q->bindValue(':acteur_id', $casting->acteur_id());
        
        return $q->execute();
    }

    public function deleteCasting(Casting $casting)
    {
        $q = $this->_db->prepare("DELETE FROM casting WHERE film_id=:film_id AND acteur_id=:acteur_id");
       
        $q->bindValue(':film_id', $casting->film_id());
        $q->bindValue(':acteur_id', $casting->acteur_id());

        return $q->execute();
    }

    public function getList($id_film = NULL)
     {
        $castings = [];

        $q = $this->_db->query("
            SELECT casting.acteur_id, casting.film_id, acteur.id as aid, 
            acteur.nom as anom, acteur.prenom as aprenom, 
            film.id as fid, film.nom as fnom, film.annee as fannee,
            film.score as fscore, film.nb_vote as fnb_vote 
            FROM casting 
            JOIN film ON casting.film_id=film.id 
            JOIN acteur ON casting.acteur_id=acteur.id" .
            (isset($id_film) ? " WHERE casting.film_id = $id_film" : "")
        );



        $i = 0;
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $casting = array("film_id" => $donnees["film_id"], "acteur_id" => $donnees["acteur_id"]);
            $acteur = array("id" => $donnees["aid"], "prenom" => $donnees["aprenom"], 
            "nom" => $donnees["anom"]);
            $film = array("id" => $donnees["fid"], "nom" => $donnees["fnom"], 
            "annee" => $donnees["fannee"], "score" => $donnees["fscore"], "nb_vote" => $donnees["fnb_vote"]);
            $castings[$i]["casting"] = new Casting($casting);
            $castings[$i]["acteur"] = new Acteur($acteur);
            $castings[$i]["film"] = new Film($film);
            $i++;
        }

        return $castings;

    }

    public function getByIdF($id)
    {
        $q = $this->_db->query("
            SELECT * FROM casting
            WHERE film_id=".$id);
        $castings = array();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $castings[] = new Casting($donnees);
        }
        
        return $castings;
    }

    public function getByIdA($id)
    {
        $q = $this->_db->query("
            SELECT * FROM casting
            WHERE acteur_id=".$id);
        $castings = array();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $castings[] = new Casting($donnees);
        }
        
        return $castings;
    }

    public function getBy(Film $film, Acteur $acteur)
    {
        $q = $this->_db->query("
            SELECT * FROM casting 
            JOIN film ON casting.film_id=film.id 
            JOIN acteur ON casting.acteur_id=acteur.id 
            WHERE casting.acteur_id=".$acteur->id()." 
            AND casting.film_id=".$film->id());
        $castings = array();
        while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
        {
            $castings[] = new Casting($donnees);
        }
        
        return $castings;
    }
}


?>
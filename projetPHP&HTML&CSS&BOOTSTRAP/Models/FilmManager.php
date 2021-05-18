<?php

require_once("Film.class.php");
require_once("Acteur.class.php");

class FilmManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function getById($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM film WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Film($donnees);
  }

  public function getList()
  {
    $films = [];

    $q = $this->_db->query('SELECT * FROM film ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $films[] = new Film($donnees);
    }

    return $films;
  }

  public function getFilmsWithActor(Acteur $acteur)
  {
    $q = $this->_db->query("SELECT * FROM film JOIN casting ON film.id=casting.film_id WHERE casting.acteur_id=".$acteur->id());
    $films = array();
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $films[] = new Film($donnees);
    }
    
    return $films;
  }

  public function addFilm(Film $film)
  {
    $q = $this->_db->prepare('INSERT INTO film(nom, annee, score, nb_vote) VALUES(:nom, :annee, :score, :nbVotants)');

    $q->bindValue(':nom', $film->nom());
    $q->bindValue(':annee', $film->annee());
    $q->bindValue(':score', $film->score());
    $q->bindValue(':nbVotants', $film->vote());

    return $q->execute();
  }

  public function updateFilm(Film $film)
  {
    $q = $this->_db->prepare('UPDATE film SET nom = :nom, annee = :annee, score = :score, nb_vote = :vote WHERE id = :id');

    $q->bindValue(':id', $film->id());
    $q->bindValue(':nom', $film->nom());
    $q->bindValue(':annee', $film->annee());
    $q->bindValue(':score', $film->score());
    $q->bindValue(':vote', $film->vote());

    return $q->execute();
  }

  public function updateScore($id, $sum){
      
  }

  public function deleteFilm($id)
  {
    return $this->_db->exec('DELETE FROM film WHERE id = '.$id);
  }
}

?>
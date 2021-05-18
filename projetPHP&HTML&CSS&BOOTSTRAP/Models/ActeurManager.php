<?php

require_once("Acteur.class.php");
require_once("Film.class.php");

class ActeurManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function getById($id)
  {
    $id = (int) $id;

    $q = $this->_db->query('SELECT * FROM acteur WHERE id = '.$id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);

    return new Acteur($donnees);
  }

  public function getList()
  {
    $acteurs = [];

    $q = $this->_db->query('SELECT * FROM acteur ORDER BY id');

    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $acteurs[] = new Acteur($donnees);
    }

    return $acteurs;
  }

  public function getActorsInFilm(Film $film)
  {
    $q = $this->_db->query("SELECT * FROM acteur JOIN casting ON acteur.id=casting.acteur_id WHERE casting.film_id=".$film->id());
    $acteurs = array();
    while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
    {
      $acteurs[] = new Acteur($donnees);
    }
    
    return $acteurs;
  }
  
  public function addActeur(Acteur $acteur)
  {
    $q = $this->_db->prepare('INSERT INTO acteur(nom, prenom) VALUES(:nom, :prenom)');
    
    $q->bindValue(':nom', $acteur->nom());
    $q->bindValue(':prenom', $acteur->prenom());

    return $q->execute();
  }

  public function updateActeur(Acteur $acteur)
  {
    $q = $this->_db->prepare('UPDATE acteur SET nom = :nom, prenom = :prenom WHERE id = :id');

    $q->bindValue(':nom', $acteur->nom());
    $q->bindValue(':prenom', $acteur->prenom());
    $q->bindValue(':id', $acteur->id());

    return $q->execute();
  }
  
  public function deleteActeur(Acteur $acteur)
  {
    return $this->_db->exec('DELETE FROM acteur WHERE id = '.$acteur->id());
  }
}
?>
<?php

class Film
{
  protected $_id;
  protected $_nom;
  protected $_annee;
  protected $_nb_vote;
  protected $_score;
  

  public function __construct(array $donnees)
  {
    $this->hydrate($donnees);
  }
  
  
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      
      if (method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }
  
  public function nom()
  {
    return $this->_nom;
  }
  
  public function annee()
  {
    return $this->_annee;
  }
  
  public function score()
  {
    return $this->_score;
  }
  
  public function vote()
  {
    return $this->_nb_vote;
  }
  
  public function id()
  {
    return $this->_id;
  }
  
  public function setId($id)
  {
    if($id>0)
    {
      $this->_id = $id;
    }
  }

  public function setNom($nom)
  {
    if (is_string($nom) && !empty($nom))
    {
      $this->_nom = $nom;
    }
  }

  public function setAnnee($annee)
  {
    $this->_annee = (int)$annee;
  }
  
  public function setNb_vote($nb_vote)
  {
    $this->_nb_vote = (int)$nb_vote;
  }
  
  public function setScore($score)
  {
    $score = floatval($score);
    if ($score  > 0) {
      $this->_score = $score;
    }
  }
}

?>
<?php

class Vote
{
  protected $_film_id;
  protected $_user_id;
  protected $_note;

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

  public function film_id()
  {
    return $this->_film_id;
  }
  
  public function user_id()
  {
    return $this->_user_id;
  }
  
  public function note()
  {
    return $this->_note;
  }

  public function setFilm_id($film_id)
  {
    $this->_film_id = (int)$film_id;
  }
  
  public function setUser_id($user_id)
  {
    $this->_user_id = (int)$user_id;
  }

  public function setNote($note)
  {
    $this->_note = (int)$note;
  }
}

?>
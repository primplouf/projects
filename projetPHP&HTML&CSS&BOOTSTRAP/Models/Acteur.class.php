<?php

class Acteur
{
  protected $_id;
  protected $_nom;
  protected $_prenom;
  

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
  
  public function prenom()
  {
    return $this->_prenom;
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
  
  public function setPrenom($prenom)
  {
    if (is_string($prenom) && !empty($prenom))
    {
      $this->_prenom = $prenom;
    }
  }
}

?>
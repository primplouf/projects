<?php

class Casting 
{
    protected $_film_id; 
    protected $_acteur_id;  

    function __construct(array $donnees){
        $this->hydrate($donnees);
    }

    function hydrate(array $donnees)
    {
        foreach($donnees as $key => $value)
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

  public function acteur_id()
  {
    return $this->_acteur_id;
  }
  
  public function setFilm_id($id)
  {
    $this->_film_id = $id;
  }
  
  public function setActeur_id($id)
  {
    $this->_acteur_id = $id;
  }
}

?>
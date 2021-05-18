<?php

require_once("Vote.class.php");

class VoteManager
{
  private $_db; // Instance de PDO

  public function __construct($db)
  {
    $this->_db = $db;
  }

  public function addVote(Vote $vote)
  {
    $q = $this->_db->prepare('INSERT INTO vote(film_id, user_id, note) VALUES(:film_id, :user_id, :note)');

    $q->bindValue(':film_id', $vote->film_id());
    $q->bindValue(':user_id', $vote->user_id());
    $q->bindValue(':note', $vote->note());

    return $q->execute();
  }

  public function updateVote(Vote $vote)
  {
    $q = $this->_db->prepare('UPDATE vote SET note = :note WHERE film_id = :film_id AND user_id = :user_id');

    $q->bindValue(':film_id', $vote->film_id());
    $q->bindValue(':user_id', $vote->user_id());
    $q->bindValue(':note', $vote->note());

    return $q->execute();
  }

  public function getByIds($film_id, $user_id){

    $q = $this->_db->query('SELECT * FROM vote WHERE film_id = '.$film_id.' AND user_id = '.$user_id);
    $donnees = $q->fetch(PDO::FETCH_ASSOC);
    if ($donnees==false){
      return [ $vote = new Vote([ "film_id" => $film_id, "user_id" => $user_id, "note" => 0 ]), "add" ];
    } else {
      return [ $vote = new Vote($donnees), "update" ];
    }
  }
}
?>
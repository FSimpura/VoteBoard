<?php
class Queries {

  private $_pdo;

  public function __construct($pdo) {
    $this->_pdo = $pdo;
  }

  // returns user object if id and password match the database
  public function identify($id, $password) {
    $query = $this->prepare('SELECT id FROM users WHERE name = ? AND password = ?');
    if ($query->execute(array($id, $password))) {
      return $query->fetchObject();
    } else {
      return null;
    }
  }
  
  // registers an user by inserting it to the database
  public function register($id, $password) {
    $query = $this->prepare('INSERT INTO users (name, password) VALUES (?, ?)');
    if ($query->execute(array($id, $password))) {
      return $query->fetchObject();
    } else {
      return null;
    }
    return null;
  }

  // checks if given vote_id exists in the open_votes view
  public function is_open($vote_id) {
    $query = $this->prepare('SELECT * FROM open_votes where id = ?');
    if ($query->execute(array($vote_id))) {
      return $query->fetchObject();
    }
    return null;
  }

  // increases the vote count of the given id by one if the voting is open
  public function givevote($vote_id, $option_id, $voter_id) {
    if ($option_id and $this->is_open($vote_id)) {
       $query = $this->prepare('INSERT INTO voted (voted, voter) VALUES (?, ?)');
       if ($query->execute(array($vote_id, $voter_id))) {
          $this->prepare('UPDATE choices SET votes = votes + 1 WHERE id = ?')->execute(array($option_id));
          return true;
      }
    }
    return false;
  }

  // returns true if given voting is publicly viewable, already closed or its creator is accessing it
  public function showvotes($vote_id, $user_id) {
    $query = $this->prepare('SELECT * FROM votes WHERE id = ?');
    $query->execute(array($vote_id));
    $vote = $query->fetchObject();
    return $vote->showvotes or !$this->is_open($vote_id) or $this->is_vote_creator($vote_id, $user_id);
  }

  // checks if the user has already voted in the given voting
  public function hasvoted($user_id, $vote_id) {
    $query = $this->prepare('SELECT * FROM voted WHERE voter = ? AND voted = ?');
    if ($query->execute(array($user_id, $vote_id))) {
       if ($query->fetchObject()) {
         return true;
       }
       return false;
    }
    return true;
  }

  // selects a voting by the given id
  public function vote($vote_id) {
    $query = $this->prepare('SELECT * FROM votes WHERE id = ?');
    if ($query->execute(array($vote_id))) {
      $vote = $query->fetchObject();
      return $vote; 
    }
    return null;
  }

  // creates a new voting if the first choice is present and otherwise valid; inserts the choices accordingly.
  public function createvote($vote_name, $vote_desc, $vote_creator, $show_votes, $end_date, $choices) {
    if ($choices[0] == null) {
      return null;
    }
    $query = $this->prepare('INSERT INTO votes (name, descr, creator, showvotes, enddate) VALUES (?, ?, ?, ?, ?) RETURNING id');
    if ($query->execute(array($vote_name, $vote_desc, $vote_creator, $show_votes, $end_date))) {
      $vote = $query->fetchObject();
      foreach($choices as $choice) {
         $query = $this->prepare('INSERT INTO choices (name, descr, voteid) VALUES (?, ?, ?)');
         $query->execute(array($choice, 'descr', $vote->id));
      }
       return true;
    }
    return null;
  }

  // checks if the user is the creator of the specified voting
  public function is_vote_creator($vote_id, $creator_id) {
    $query = $this->prepare('SELECT id FROM votes WHERE id = ? AND creator = ?');
    $query->execute(array($vote_id, $creator_id));
    return $query->fetchObject();
  }

  // deletes the voting and all the other associated data 
  public function delete_vote($vote_id, $creator_id) {
    if ($this->is_vote_creator($vote_id, $creator_id)) {
       $query = $this->prepare('DELETE FROM voted where voted = ?');
       $query->execute(array($vote_id));
       $query = $this->prepare('DELETE FROM choices where voteid = ?');
       $query->execute(array($vote_id));
       $query = $this->prepare('DELETE FROM votes where id = ?');
       $query->execute(array($vote_id));
    }
    return null;
  }

  // selects all the choices by the vote_id
  public function choices($vote_id) {
    $query = $this->prepare('SELECT * FROM choices WHERE voteid = ?');
    if ($query->execute(array($vote_id))) {
      $options = array();
      while($option = $query->fetchObject()) {
        $options[] = $option;
      }
      return $options;
    }
    return null;
  }

  // selects all the open votings
  public function open_votes() {
    $query = $this->prepare('SELECT * FROM open_votes');
    if ($query->execute()) {
      $votings = array();
      while($voting = $query->fetchObject()) {
        $votings[] = $voting;
      }
      return $votings;
    }
    return null;
  }

  // selects all the closed votings
  public function closed_votes() {
    $query = $this->prepare('SELECT * FROM closed_votes');
    if ($query->execute()) {
      $votings = array();
      while($voting = $query->fetchObject()) {
        $votings[] = $voting;
      }
      return $votings;
    }
    return null;
  }
  
  // selects all the votings created by the given user
  public function user_votes($user_id) {
    $query = $this->prepare('SELECT * FROM votes WHERE creator = ?');
    if ($query->execute(array($user_id))) {
      $votings = array();
      while($voting = $query->fetchObject()) {
        $votings[] = $voting;
      }
      return $votings;
    }
    return null;
  }

  // a help function for shorter prepare
  private function prepare($query) {
    return $this->_pdo->prepare($query);
  }

}

require dirname(__file__).'/../settings.php';

$queries = new Queries($pdo);

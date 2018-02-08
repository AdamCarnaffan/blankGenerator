<?php 

class User {
  
  public $id;
  public $username;
  public $teacher;
  
  public function __construct($data, $dbConn = null) {
    if (is_numeric($data)) {
      $getUser = "SELECT userID, username, isTeacher FROM users WHERE userID = '$data' LIMIT 1";
      $userData = $dbConn->query($getUser)->fetch_array();
    }
    if (!is_array($data) && !is_array($userData)) {
      throw new Exception("The User data stream could not be read");
    }
    $this->id = $userData['userID'];
    $this->username = $userData['username'];
    $this->teacher = ($userData['isTeacher'] == 1) ? true : false;
  }
  
}

class Quiz {
  
  public $questions = [];
  public $displayMode; // Practice or test
  public $feedbackMode; // none, score or full (practice is full by default)
  
  public function __construct() {
    
  }
  // Made up of questions
  // has a mode (test - instant feedback, test - no feedback, test - score feedback, practice)
}

class Question {
  
  public $text = []; // ordered snippets Array
  public $blanks = []; // ordered blanks array
  // alternate to build question with form
  
  public function __construct() {
    
  }
  
}

class Blank {
  // has an answer as well as generation of possible accepted answers
  // has a language
  
  public $id;
  public $answer;
  
  public function __construct() {
    
  }
  
}

 ?>

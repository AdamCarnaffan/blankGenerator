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
  // Made up of questions
  // has a mode (test - instant feedback, test - no feedback, test - score feedback, practice)
}

class Question {
  // Made up of text + blanks
  // ordered snippets Array
  // ordered blanks array
  // alternate to build question with form
}

class Blank {
  // has an answer as well as generation of possible accepted answers
  // has a language
}

 ?>

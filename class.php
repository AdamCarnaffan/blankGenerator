<?php

// All question fetching could be reduced to one query as a possible handling method
// This should be done later

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

class Class {
  // Display all quizes from a teacher and allow the teacher to see results here
}

class Quiz {

  public $id;
  public $class;
  public $title;
  public $questions = [];
  public $displayMode; // Practice or test
  public $feedbackMode; // none, score or full (practice is full by default)
  public $saveResults;
  public $displayNumbers = false;

  public function __construct($id, $class, $dbConn, $params = null) {
    $this->id = $id;
    $getData = "SELECT title FROM quizes WHERE quizID = '$this->id' LIMIT 1";
    $this->title = $dbConn->query($getData)->fetch_array()[0];
    $getQuestions = "SELECT questionID FROM quiz_questions WHERE quizID = '$this->id'";
    $result = $dbConn->query($getQuestions);
    while ($question = $result->fetch_array()) {
      $this->questions[] = new Question($question['questionID'], $dbConn);
    }
    // Handle Parameters
    $this->displayMode = 1;
    $this->feedbackMode = 3;
    $this->saveResults = false;
  }
  // Made up of questions
  // has a mode (test - instant feedback, test - no feedback, test - score feedback, practice)
}

class Question {

  public $id;
  public $text = []; // ordered snippets Array
  public $blanks = []; // ordered blanks array
  // alternate to build question with form

  public function __construct($id, $dbConn) {
    $this->id = $id;
    $getText = "SELECT content FROM questions WHERE questionID = '$this->id' LIMIT 1";
    $this->text = explode("~{&BLANK}~", $dbConn->query($getText)->fetch_array()[0]);
    $blanks = $dbConn->query("SELECT blankID FROM question_blanks WHERE questionID = '$this->id'");
    while ($blank = $blanks->fetch_array()) {
      $blanks[] = new Blank($blank['blankID'], $dbConn);
    }
  }

}

class Blank {
  // has an answer as well as generation of possible accepted answers
  // has a language

  public $id;
  public $answer;
  public $acceptedAnswers = [];
  public $lang;
  public $accentLenient;

  public function __construct($id, $dbConn) {
    $this->id = $id;
    $getData = "SELECT blankText, language, accentLenient FROM blanks WHERE blankID = '$this->id' LIMIT 1";
    $data = $dbConn->query($getData)->fetch_array();
    $this->answer = $data['blankText'];
    $this->lang = $data['language'];
    $this->accentLenient = ($data['accentLenient'] == 1) ? true : false;
  }

}

 ?>

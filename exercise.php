<?php

require_once("handler.php");
require_once("dbConnect.php");
require_once("class.php");

// Get the ID for the particular exercise
$quizID = $_GET['quizid'] ?? null;
$classID = $_GET['classid'] ?? null;

// Handle no target quiz first
if ($quizID == null || !$conn->query("SELECT quizID FROM quizes WHERE quizID = '$quizID'")->fetch_array()) {
  header(handleNotFound(1));
}

// Build the quiz
$quiz = new Quiz($quizID, $conn);

 ?>

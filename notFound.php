<?php

$type = $_GET['type'] ?? 0;

switch ($type) {
  case 1: // header sent from exercise.php
    echo "No exercise was found here";
    break;
  case 2: // header sent from feedback screen
    echo "No data was found";
    break;
  default:
    echo "We're not sure what you're looking for... sorry";
}

?>

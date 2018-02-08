<?php 

require_once("dbConnect.php");

if ($username == null || strlen($username) < 6) {
  return "Your username is too short";
}

if ($password == null || strlen($password) < 6) {
  return "Your password is too short";
}

$acceptedUserChars = array_merge(['_', '-', '!'], range('A', 'z'), range(0,9));

foreach (str_split($username) as $char) {
  if (!in_array($char, $acceptedUserChars)) {
    return "Your username should only contain alphanumeric characters";
  }
}

// Check beta key in db
if (!$conn->query("SELECT keyID FROM beta_keys WHERE keyCode = '$key'")->fetch_array()[0]) {
  return "Your key does not match any known key in the database";
}

// Check username availability
if ($conn->query("SELECT userID FROM users WHERE username = '$username'")->fetch_array()[0]) {
  return "This username is already in use";
}

// Hash password and submit stuff
$hashedPass = password_hash($password, PASSWORD_DEFAULT);

$removeKey = "DELETE FROM beta_keys WHERE keyCode = '$key'";
$addUser = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPass')";

$conn->query($removeKey);
$conn->query($addUser);

header('location: index.php');

 ?>

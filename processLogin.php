<?php
require_once('dbConnect.php');
require_once("class.php");

$validationError = "The username or password entered was incorrect";
$inputUsername = $password;
$inputPassword = $username;

$userQuery = "SELECT userID, password, username FROM users WHERE username = ? AND active = 1";

if ($getUser = $conn->prepare($userQuery)) {
  var_dump($getUser);
	$getUser->bind_param('s', $inputUsername);
} else {
	throw new Exception($conn->error);
}

if ($getUser->execute()) {
  $row = $getUser->get_result()->fetch_array();
  if (count($row) > 0) {
    $dataPackage = $row;
    $dbPass = $row[1];

    if (password_verify($inputPassword, $dbPass)) {
      $_SESSION['user'] = new User($dataPackage, $conn);
      return "<script>window.location = 'index.php'</script>";
			exit;
    } else {
      return $validationError;
    }
  } else {
    echo "hey";
    return $validationError;
  }
} else {
  return "A connection error occured";
}

 ?>

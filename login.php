<?php

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;

$error = include('processLogin.php');

if (isset($_POST['submit'])) {
  echo $error;
}

 ?>

 <h1>Login</h1>

 <form method='POST' action=''>
   <input type='text' name='username' placeholder='Username' value='<?php echo $username ?>'></br>
   <input type='password' name='password' placeholder='Password' value='<?php echo $password ?>'></br>
   <input type='submit' name='submit' value='Login'>
 </form>

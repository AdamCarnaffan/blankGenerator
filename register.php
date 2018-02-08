<?php 

$username = $_POST['username'] ?? null;
$password = $_POST['password'] ?? null;
$key = $_POST['key'] ?? null;

$error = include('processRegister.php');

if (isset($_POST['submit'])) {
  echo $error;
}

 ?>

 <h1>Registration</h1>
 
 <form method='POST' action=''>
   <input type='text' name='username' placeholder='Username' value='<?php echo $username ?>'></br>
   <input type='password' name='password' placeholder='Password' value='<?php echo $password ?>'></br>
   <input type='text' name='key' placeholder='Beta Key' value='<?php echo $key ?>'></br>
   <input type='submit' name='submit' value='Register'>
 </form>

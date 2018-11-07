<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

include ("account.php");

$db = mysqli_connect($hostname, $username, $password, $project);

if (mysqli_connect_errno()) {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  exit();
}
print "Successfully connected to MySQL.<br><br><br>";

$email = filter_input(INPUT_POST, 'email');
$pass = filter_input(INPUT_POST, 'password');
$passlength = strlen($pass);
$errors = array();

if (empty($email)) {
  echo "You forgot to enter your e-mail<br><br>";
  break;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  echo "Invalid email format<br><br>"; 
}
  
if (empty($pass)) {
  echo "You forgot to enter a password";
  break;
}
else {
  if ($passlength < 8) {
    echo "Password must be at least 8 characters long<br><br>"; 
  }
}

$query = "SELECT * FROM accounts WHERE email='$email' AND password='$pass'";
$result=mysqli_query($db, $query);
if(mysql_num_rows($result)<1) {
  echo"Email is not in our database";
  break;
}

if (count($errors) == 0) {
  echo "Login Successful";
}

?>

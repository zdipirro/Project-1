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

$first = filter_input(INPUT_POST, 'first');
$last = filter_input(INPUT_POST, 'last');
$bday = filter_input(INPUT_POST, 'bday');
$email = filter_input(INPUT_POST, 'email');
$pass = filter_input(INPUT_POST, 'pass');
$errors = array();
$passlength = strlen($pass);
  
if (empty($first)) {
  echo "You forgot to enter your first name<br><br>";
  break;
}

  
if (empty('last')) {
  echo "You forgot to enter your last name<br><br>";
  break;
}

    
if (empty('bday')) {
  echo "You forgot to enter your first name<br><br>";
  break;
}

  
if (empty('email')) {
  echo "You forgot to enter you email address<br><br>";
  break;
}
else {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "You entered an invalid email address<br><br>";
    break;
  }
}
  
if (empty('pass')) {
  echo "You forgot to enter your password<br><br>";
  break;
}
else {
  if ($passlength < 8) {
    echo "Password must be at least 8 characters long<br><br>"; 
  }
} 


if (count($errors) == 0) {
  echo "Registered Successfully";
  $sql = "INSERT INTO accounts (birthday, email, fname, lname, password) VALUES ('$bday', '$email', '$first', '$last', '$pass')";
  mysqli_query($db, $sql);
}
?>
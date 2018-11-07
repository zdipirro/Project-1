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


$errors = array();
$qname = filter_input(INPUT_POST, 'qname');
$qbody = filter_input(INPUT_POST, 'qbody');
$qskills = filter_input_array(INPUT_POST, 'qskills');

$qnlength = strlen($qname);
$qblength = strlen($qbody);
$qslength = strlen($qskills);

while(TRUE) {
if (empty($qname)) {
  echo "You forgot to enter the name of your question<br><br>";
  break;
}
else {
  if ($qnlength < 3) {
    echo "Question name must be at least 3 characters long<br><br>";
    break;
  }
}

if (empty($qbody)) {
  echo "You forgot to enter information into the question body<br><br>";
  break;
}
else {
  if ($qblength > 500) {
    echo "Question body has a maximum length of 500 characters<br><br>"; 
    break;
  }
}

if ($qslength < 2) {
  echo "You need to enter at least two skills";
  break;
}
else { 
  if (is_array($qskills)) && if (count($errors) == 0) {
    $sep = implode(", ", $qskills);
    echo "Question Form Submitted";
    $sql = "INSERT INTO questions (title, body, skills) VALUES ('$qname', '$qbody', '$sep')";
    mysqli_query($db, $sql);
    break;
}
}
}


$db->close();
?> 
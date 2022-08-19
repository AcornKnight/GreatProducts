<?php
require_once('./settings.php');




$con = mysqli_connect($host, $username, $password, $dbname);
if ( mysqli_connect_errno() ) {
 // If there is an error with the connection, stop the script and display the error.
 exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.

echo '<hr />';
if ( !isset($_POST['username'], $_POST['userpass'],$_POST['email']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill all fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.

$stmt = $con->prepare("INSERT INTO User (`Username`, `Userpass`, `Email`) VALUES (:username, :password, :email)");
$stmt->bindParam(':username', $_POST['username']);

$password = password_hash($_POST['userpass'], PASSWORD_DEFAULT);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':email', $_POST['email']);


$stmt->execute();

header('Location: ./index.php');
?>

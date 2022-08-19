<?php
  require_once(__DIR__.'/../Utils/settings.php');
  require_once(__DIR__.'/../Utils/utils.php');
  guard("guest");

// Now we check if the data from the login form was submitted, isset() will check if the data exists.

echo '<hr />';
if ( !isset($_POST['username'], $_POST['userpass'],$_POST['email']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill all fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.

$stmt = $con->prepare("INSERT INTO User (`Username`, `Userpass`, `Email`) VALUES (?, ?, ?)");
$password = password_hash($_POST['userpass'], PASSWORD_DEFAULT);
$params = [$_POST['username'], $password,  $_POST['email']];
$stmt->bind_param('sss', ...$params);

$stmt->execute();

header('Location: ../index.php');
?>

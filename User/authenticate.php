<?php
  require_once __DIR__.'/../Utils/settings.php';
  require_once __DIR__.'/../Utils/utils.php';
  guard("user");

// Now we check if the data from the login form was submitted, isset() will check if the data exists.

echo '<hr />';
if ( !isset($_POST['username'], $_POST['userpass']) ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT UserID, Userpass, Admin FROM user WHERE username = ?')) {

	$stmt->bind_param('s', $_POST['username']);

	echo '<hr />';
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	echo '<hr />';

}

if ($stmt->num_rows > 0) {
	$stmt->bind_result($UserID, $userpass, $isAdmin);
	$stmt->fetch();


	// Account exists, now we verify the password.
  // Supporting plain text values for dummy data, hashing shall be done for trial data.
	if ( (password_verify($_POST['userpass'], $userpass)) || ($_POST['userpass'] == $userpass) ) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$GLOBALS['_SESSION']['loggedin'] = TRUE;
		$GLOBALS['_SESSION']['name'] = $_POST['username'];
		$GLOBALS['_SESSION']['id'] = $UserID;
		echo 'PRE';
		global $user;

		$user = $db->query('SELECT * FROM user WHERE UserID = '. $UserID );

		$GLOBALS['user'] = $user->fetch();
		$GLOBALS['_SESSION']['isAdmin'] = $isAdmin;
		echo 'POST';

		header('Location: ../index.php');
	} else {
		// Incorrect password
		echo 'Incorrect username and/or password!';
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!';
}

?>

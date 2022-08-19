<?php
	require_once(__DIR__.'/../Utils/settings.php');
	require_once(__DIR__.'/../Utils/utils.php'); ?>
<!DOCTYPE html>
<!-- Sign-in page for our Great products database. -->
<!-- Noah R Gestiehr. This page should display a login form to the user and authenticate it -- >
<!-- On successful authentication, should redirect user to the landing page. Otherwise errors -->
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign-up</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../ style.css" rel="stylesheet" type="text/css">

    $con = mysqli_connect($host, $username, $password, $dbname);
    if ( mysqli_connect_errno() ) {
     // If there is an error with the connection, stop the script and display the error.
     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
    }
	</head>
	<body>
		<div class="login">
			<h1>Sign-up</h1>
			<form action="./User/resgister.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<label for="E-mail">
					<i class="fas fa-envelope-open"></i>
				</label>
				<input type="text" name="email" placeholder="Email" id="email" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="userpass" placeholder="Password" id="userpass" required>
				<input type="submit" value="Login">
			</form>
		</div>
	</body>
</html>

<?php
	require_once(__DIR__.'/../Utils/settings.php');
	require_once(__DIR__.'/../Utils/utils.php');
    guard("guest");
?>
<!DOCTYPE html>
<!-- Sign-in page for our Great products database. -->
<!-- Noah R Gestiehr. This page should display a login form to the user and authenticate it -->
<!-- On successful authentication, should redirect user to the landing page. Otherwise errors -->
<html>
	<head>
		<meta charset="utf-8">
		<title>Sign-up</title>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<nav class="navtop">
	    <div>
	      <h1>Great Products</h1>
	      <a href="../index.php"><i class="fas fa-archive"></i>Main</a>
	      <a href="./profile.php"><i class="fas fa-user-circle"></i>Profile</a>
	      <a href="./logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
	    </div>
	  </nav>
		<div class="login">
			<h1>Sign-up</h1>
			<form action="./register.php" method="post">
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
				<input type="submit" value="Register">
			</form>
		</div>
	</body>
</html>

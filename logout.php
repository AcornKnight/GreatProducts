<?php

// This file just terminates the users curretn session on logout then redirects them to the general user area.
//session_start();
//session_destroy();

session_start();
unset($_SESSION["username"]);
unset($_SESSION["password"]);

echo 'You have logged out.';
// Redirect to the landing page:
header('Location: index.php');
?>

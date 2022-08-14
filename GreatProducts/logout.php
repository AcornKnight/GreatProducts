<?php

// This file just terminates the users curretn session on logout then redirects them to the general user area.
session_start();
session_destroy();
// Redirect to the landing page:
header('Location: index.php');
?>

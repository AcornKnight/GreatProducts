<?php
require_once('settings.php');
require_once('lib/mysql.php');
//DELETE
$db->query("DELETE FROM quotes WHERE ID =".$_GET['index']);

echo '<a href="index.php">Go back</a>';


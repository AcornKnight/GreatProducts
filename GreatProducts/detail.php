<?php
require_once('settings.php');
require_once('lib/mysql.php');

echo '<hr />';
// READ ONE
$result=$db->query('SELECT * FROM quotes WHERE ID='.$_GET['index']);
$row=$result->fetch();
print_r($row);

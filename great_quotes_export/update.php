<?php
require_once('settings.php');
require_once('lib/mysql.php');

if(count($_POST)>0){
	// UPDATE
	$db->query("UPDATE quotes SET quote='".$_POST['quote']."' WHERE ID =".$_GET['index']);
}else{
	$result=$db->query('SELECT * FROM quotes WHERE ID='.$_GET['index']);
	$result=$result->fetch();
}
echo '
	<form method="POST" action="update.php?index='.$_GET['index'].'">
		Author ID<br />
		<input type="text" name="author_ID" value="'.$result['author_ID'].'" /><br /><br />
		Quote<br />
		<textarea name="quote">'.$result['quote'].'</textarea><br /><br />
	
		<button type="submit">Submit</submit>
	</form>';




<?php
require_once('settings.php');
require_once('lib/mysql.php');

if(count($_POST)>0){
	// CREATE
	$db->query("INSERT INTO quotes(ID,author_ID,quote) VALUES (NULL, '".$_POST['author_ID']."', '".$_POST['quote']."')");
	header('location:detail.php?index='. $db->lastInsertId());
}else{
	$result=$db->query('SELECT * FROM authors');
}
echo '
	<form method="POST">
		Author ID<br />
		<select name="author_ID">';
		while($row=$result->fetch()) echo '<option value="'.$row['ID'].'">'.$row['firstname'].' '.$row['lastname'].'</option>';
		echo '
		</select><br /><br />
		Quote<br />
		<textarea name="quote"></textarea><br /><br />
	
		<button type="submit">Submit</submit>
	</form>';


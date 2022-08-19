<?php
require_once('settings.php');
require_once('lib/mysql.php');

echo '<a href="create.php">Create new quote</a>';

// READ ALL
$result=$db->query('SELECT * FROM quotes');
echo '<table border="1">';
while($row=$result->fetch()){
	//print_r($row);
	echo '<tr>
			<td><a href="detail.php?index='.$row['ID'].'">'.$row['ID'].'</a></td>
			<td><a href="detail.php?index='.$row['ID'].'">'.$row['author_ID'].'</a></td>
			<td><a href="detail.php?index='.$row['ID'].'">'.$row['quote'].'</a></td>
			<td><a href="update.php?index='.$row['ID'].'">Update quote</a></td>
			<td><a href="delete.php?index='.$row['ID'].'">Delete quote</a></td>
		</tr>';
}
echo '</table >';
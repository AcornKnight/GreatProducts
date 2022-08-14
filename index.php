<<<<<<< Updated upstream
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
=======
<?php
require_once('GreatProducts/settings.php');
require_once('GreatProducts/lib/mysql.php');

if($user) {
    echo 'Hello '.$user['Username'];
    echo '<a href="profile.php">Profile</a>';
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<form action="/login.php">
      <label for="userid">User ID:</label>
      <input type="text" id="userid" name="userid"><br><br>
      <label for="passwd">Password:</label>
      <input type="text" id="passwd" name="passwd"><br><br>
      <input type="submit" value="Login">
    </form>';
}

// READ ALL
$products=$db->query('SELECT * FROM products');
echo '<table border="1">';
while($row=$products->fetch()){
//    print_r($row);
    echo '
        <tr>
            <td><a href="details.php?ProductID='.$row['ProductID'].'">'.$row['Name'].'</a></td>
            <td>'.$row['Cost'].'</td>
        </tr>
    </a>';
}
>>>>>>> Stashed changes
echo '</table >';
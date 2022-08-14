<<<<<<< Updated upstream
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
    echo '<tr>
        <td>'.$row['Name'].'</td>
        <td>'.$row['Cost'].'</td>
    </tr>';
}
<<<<<<< HEAD
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
=======
echo '</table >';

?>
>>>>>>> eaa2dfaa695e9a7f7e9a19d0cbecdccd2b9ceb45

<?php
require_once('settings.php');

// "By Category" Can be manually driven until wired up in the interface with:
// http://localhost/GreatProducts/index.php?CategoryID=1

if($user) {
    echo 'Hello '.$user['Username'];
    echo '<a href="profile.php">Profile</a>';
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<a href="login.php">Login</a>';
}
echo '<hr />';
$selStatement = 'SELECT * FROM products';
if (isset($_GET['CategoryID'])) {
    $selStatement .= ' WHERE ProductID IN (SELECT ProductID FROM ProductCategory WHERE CatID = ' . $_GET['CategoryID'] . ')';
    $cat = $db->query('SELECT CatName FROM category WHERE CatID = '.$_GET['CategoryID']);
    $cat = $cat->fetch();
    echo '<h3> Products in category: ' . $cat['CatName'] . '</h3><hr />';
}
// READ ALL
$products=$db->query($selStatement);
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
echo '</table >';
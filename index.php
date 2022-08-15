<?php
require_once('settings.php');

// "By Category" Can be manually driven until wired up in the interface with:
// http://localhost/GreatProducts/index.php?CategoryID=1
if(isset($_SESSION['name'])) {
    echo 'Hello '.$_SESSION['name'].'<br/>';
    echo '<a href="profile.php?UserID='.$_SESSION['id'].'">Profile</a><br/>';
    echo '<a href="logout.php">Logout</a><br/>';
} else {
    echo '<a href="login.php">Login</a><br/>';
}
echo '<hr />';
$selStatement = 'SELECT * FROM products';
if (isset($_GET['CategoryID'])) {
    $selStatement .= ' WHERE ProductID IN (SELECT ProductID FROM ProductCategory WHERE CatID = ' . $_GET['CategoryID'] . ')';
    $cat = $db->query('SELECT CatName FROM category WHERE CatID = '.$_GET['CategoryID']);
    $cat = $cat->fetch();
    echo '<h3> Products in category: ' . $cat['CatName'] . '</h3>'
    .'<a href="./index.php">Clear Category</a>'
    .'<hr />';
}
// READ ALL
$products=$db->query($selStatement);
$categories=$db->query('SELECT * FROM Category');

echo '<table border="2">';
echo '<tr><td>';

// Category list
echo '<table border="1">';
while($row=$categories->fetch()){
//    print_r($row);
    echo '
        <tr>
            <td><a href="index.php?CategoryID='.$row['CatID'].'">'.$row['CatName'].'</a></td>
        </tr>
    </a>';
}
echo '</table >';
// END of Category list

echo '</td><td>';

// Product list
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
// END of Product list

echo '</tr></table >';
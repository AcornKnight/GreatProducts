<?php require_once('settings.php'); ?>
<!DOCTYPE html>
<!-- Our main landing page. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Main</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Great Products</h1>
      <?php

      if(isset($_SESSION['name'])) {
          echo '<a href="index.php"><i class="fas fa-archive"></i>Main</a>';
          if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
            echo '<a href="admin.php"><i class="fas fa-ad"></i>Admin</a>';
          }
          echo '<a href="profile.php?UserID='.$_SESSION['id'].'">Profile</a><br/>';
          echo '<a href="logout.php">Logout</a><br/>';
      } else {
          echo '<a href="login.php">Login</a><br/>';
      }
      echo '<hr />';
      ?>
    </div>
  </nav>

<?php

if(isset($_SESSION['name'])) {
    echo 'Hello '.$_SESSION['name'].'<br/>';
    echo '<hr />';
  }
// "By Category" Can be manually driven until wired up in the interface with:
// http://localhost/GreatProducts/index.php?CategoryID=1

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
?>
    </div>
  </body>
</html>

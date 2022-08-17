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
          echo '<a href="cart.php"><i class="fas fa-cart-plus"></i>Cart</a>';
          echo '<a href="logout.php">Logout</a><br/>';
      } else {
          echo '<a href="login.php">Login</a><br/>';
      }
      echo '<hr />';
      ?>
    </div>
  </nav>

  <?php


//print_r($_GET);
$prod_id = $_GET['ProductID'];
if($prod_id) {
    $p = $db->query('SELECT * FROM products WHERE ProductID =' . $_GET['ProductID']);
    $product = $p->fetch();
    if($product) {
        echo '<h2>' . $product["Name"] . '</h2>';
        echo '<hr /><p>' . $product["Details"] . '</p>';
        echo '<hr /><h2>' . $product["Cost"] . '</h2>';
        echo '<h4>Quantity Available: '.$product["Count"].'</h4>';
        if (isset($_SESSION['id']) && ($product["Count"] > 0)) {
            echo '<form action="add2cart.php" method="get">' .
                '<input type="hidden" name="ProductID" value=' . $product["ProductID"] . '>' .
                '<input type="submit" value="Add to Cart">' .
                '</form>';
        }
    } else {
        echo '<h3>ProductID '. $_GET['ProductID'] .' not found</h3>';
    }
} else {
    echo '<h3>ProductID not specified</h3>';
}

echo '<hr /><a href="./index.php">CLOSE</a>';

    ?>
    
  </body>
</html>

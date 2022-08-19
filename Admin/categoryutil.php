<?php require_once('../Utils/settings.php');
      require_once('../Utils/utils.php'); ?>
<!DOCTYPE html>
<!-- Admin Category CRUD support file for our Great products database. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Category Utility</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Great Products</h1>
      <a href="index.php"><i class="fas fa-archive"></i>Main</a>
      <?php
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
          echo '<a href="../Admin/admin.php"><i class="fas fa-ad"></i>Admin</a>';
        }
       ?>
      <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
      <a href="cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>
<?php

function mapped_implode($glue, $array, $symbol = '=') {
    return implode($glue, array_map(
            function($k, $v) use($symbol) {
                return $k . $symbol . $v;
            },
            array_keys($array),
            array_values($array)
        )
    );
}



// CATEGORY CRUD BELOW
  if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "categorydelete") {
        global $db;
        $db->query('DELETE FROM Category where CatID = ' . $_GET['CatID']);
        header('Location: ../Admin/admin.php');
    } else if ($_GET['action'] == "categoryupdate") {
        global $db;
        $categorylist = $db->query('SELECT * FROM Category WHERE CatID = '.$_GET['CatID']);
        $category = $categorylist->fetch();

        echo '<div class="address">';
        echo '<form action="../Admin/categoryutil.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="CatID" placeholder="CatID" id="CatID" value="'. $_GET['CatID'] .'" required>'.
            '<label>Category Name<label/>'.
            '<input type="text" name="CatName" placeholder="CatName" id="CatName" required value="'.$category["CatName"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else if ($_GET['action'] == "categorycreate") {
        echo '<div class="address">';
        echo '<form action="../Admin/categoryutil.php" method="post" class="AddressForm">'.
            '<label>Category Name<label/>'.
            '<input type="text" name="CatName" placeholder="CatName" id="CatName" required>'.
            '<input type="submit" value="Add" class="create">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else if (!isset($_GET['action'])) {
        // unknown GET action
        header('Location: admin.php');
    }
} else if(isset($_POST['CatID']) && isset($_POST['CatName'])) {
    // Incoming update action from our form
    global $db;
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE Category SET '. mapped_implode('",', $_POST, '="').'" WHERE CatID = '.$_POST['CatID']);
    header('Location: admin.php');
} else if(isset($_POST['CatName'])) {
    // Incoming create action from our form
    global $db;
    $db->exec('INSERT INTO Category (`CatName`) VALUES ("' .implode('","', $_POST).'")');
    header('Location: admin.php');
}

?>
  </body>
</html>

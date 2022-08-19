<?php
      require_once('../Utils/settings.php');
      require_once('../Utils/utils.php');

  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['loggedin'])) {
	  header('Location: ../index.php');
	  exit;
    }
    global $host, $username, $password, $dbname;
    $con = mysqli_connect($host, $username, $password, $dbname);
    if (mysqli_connect_errno()) {
	     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
       }
    // We don't have the password or email info stored in sessions so instead we can get the results from the database.
    $stmt = $con->prepare('SELECT userpass, Email FROM user WHERE UserID = ?');
    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($userpass, $Email);
    $stmt->fetch();
    $stmt->close();

    $userlist = $db->query('SELECT * FROM user');

?>

<!DOCTYPE html>
<!-- Admin CRUD support file for our Great products database. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Admin User CRUD</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../style.css" rel="stylesheet" type="text/css">
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
      <a href="../User/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
      <a href="../Shop/cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
      <a href="../User/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
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


// PRODUCT CRUD BELOW
if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "productdelete") {
        global $db;
        $db->query('DELETE FROM Products where ProductID = ' . $_GET['ProductID']);
        header('Location: ../User/profile.php');
    } else if ($_GET['action'] == "productupdate") {
        global $db;
        $productlist = $db->query('SELECT * FROM Products WHERE ProductID = '.$_GET['ProductID']);
        $products = $productlist->fetch();

        echo '<div class="address">';
        echo '<form action="../Admin/productutil.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="ProductID" placeholder="ProductID" id="ProductID" value="'. $_GET['ProductID'] .'" required>'.
            '<label>Name<label/>'.
            '<input type="text" name="Name" placeholder="Name" id="Name" required value="'.$products["Name"].'">'.
            '<label>Cost</label>'.
            '<input type="text" name="Cost" placeholder="Cost" id="Cost" required value="'.$products["Cost"].'">'.
            '<label>Details</label>'.
            '<input type="text" name="Details" placeholder="Details" id="Details" required value="'.$products["Details"].'">'.
            '<label>Count</label>'.
            '<input type="text" name="Count" placeholder="count" id="Count" required value="'.$products["count"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="../Admin/admin.php" class="cancel">Cancel</a></div>';
    } else if ($_GET['action'] == "productcreate") {
        echo '<div class="address">';
        echo '<form action="../Admin/productutil.php" method="post" class="AddressForm">'.
            '<label>Name<label/>'.
            '<input type="text" name="Name" placeholder="Name" id="Name" required>'.
            '<label>Cost</label>'.
            '<input type="text" name="Cost" placeholder="Cost" id="Cost" required>'.
            '<label>Details</label>'.
            '<input type="text" name="Details" placeholder="Details" id="Details" required>'.
            '<label>Count</label>'.
            '<input type="text" name="Count" placeholder="Count" id="Count" required>'.
            '<input type="submit" value="Add" class="create">'.
            '</form>';
        echo '<a href="../Admin/admin.php" class="cancel">Cancel</a></div>';
    } else if (!isset($_GET['action'])) {
        // unknown GET action
        header('Location: ../Admin/admin.php');
    }
} else if(isset($_POST['ProductID']) && isset($_POST['Name']) && isset($_POST['Cost']) && isset($_POST['Details']) && isset($_POST['Count'])) {
    // Incoming update action from our form
    global $db;
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE Products SET '. mapped_implode('",', $_POST, '="').'" WHERE ProductID = '.$_POST['ProductID']);
    header('Location: admin.php');
} else if(isset($_POST['Name']) && isset($_POST['Cost']) && isset($_POST['Details']) && isset($_POST['Count'])) {
    // Incoming create action from our form
    global $db;
    $db->exec('INSERT INTO Products (`Name`, `Cost`, `Details`, `Count`) VALUES ("' .implode('","', $_POST).'")');
    header('Location: ../Admin/admin.php');
}
?>
  </body>
</html>

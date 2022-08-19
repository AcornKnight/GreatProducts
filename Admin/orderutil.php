<?php
  require_once(__DIR__.'/../Utils/settings.php');
  require_once(__DIR__.'/../Utils/utils.php');
  guard("admin");

  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['loggedin'])) {
	  header('Location: ../index.php');
	  exit;
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
      <a href="../index.php"><i class="fas fa-archive"></i>Main</a>
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

// Order UD BELOW
if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "orderdelete") {
        global $db;
        $db->exec('DELETE FROM invoice where OrderID = ' . $_GET['OrderID']);
        header('Location: ./admin.php');
    } else if ($_GET['action'] == "orderupdate") {
        global $db;
        $order = $db->query('SELECT * FROM invoice WHERE OrderID = '.$_GET['OrderID']);
        $orderlist = $order->fetch();
        $user = $db->query('SELECT * FROM user WHERE UserID = '.$orderlist['UserID']);
        $user = $user->fetch();
        $address = $db->query('SELECT * FROM address WHERE AddressID = '.$orderlist['AddressID']);
        $address = $address->fetch();
        $products = $db->query('SELECT * FROM products WHERE ProductID in (SELECT ProductID from productorder WHERE OrderID = '.$orderlist["OrderID"].')');

        echo '<div class="order">';
        echo '<form action="orderutil.php" method="post" >'.
            '<input type="hidden" name="OrderID" placeholder="OrderID" id="OrderID" value="'. $_GET['OrderID'] .'" required>'.
            '<label>Status:<label/><br>';

        switch($orderlist["Status"]) {
            case "cart":
                echo '<input type="radio" name="Status" value="cart" checked ><label>CART</label><br>'.
                    '<input type="radio" name="Status" value="ordered"><label>ORDERED</label><br>'.
                    '<input type="radio" name="Status" value="shipped"><label>SHIPPED</label><br>'.
                    '<input type="radio" name="Status" value="delivered"><label>DELIVERED</label><br>';
                break;
            case "ordered":
                echo '<input type="radio" name="Status" value="cart"><label>CART</label><br>'.
                    '<input type="radio" name="Status" value="ordered" checked ><label>ORDERED</label><br>'.
                    '<input type="radio" name="Status" value="shipped"><label>SHIPPED</label><br>'.
                    '<input type="radio" name="Status" value="delivered"><label>DELIVERED</label><br>';
                break;
            case "shipped":
                echo '<input type="radio" name="Status" value="cart"><label>CART</label><br>'.
                    '<input type="radio" name="Status" value="ordered"><label>ORDERED</label><br>'.
                    '<input type="radio" name="Status" value="shipped" checked ><label>SHIPPED</label><br>'.
                    '<input type="radio" name="Status" value="delivered"><label>DELIVERED</label><br>';
                break;
            case "delivered":
                echo '<input type="radio" name="Status" value="cart"><label>CART</label><br>'.
                    '<input type="radio" name="Status" value="ordered"><label>ORDERED</label><br>'.
                    '<input type="radio" name="Status" value="shipped"><label>SHIPPED</label><br>'.
                    '<input type="radio" name="Status" value="delivered" checked  ><label>DELIVERED</label><br>';
                break;
            default:
                echo '<input type="radio" name="Status" value="cart"><label>CART</label><br>'.
                    '<input type="radio" name="Status" value="ordered"><label>ORDERED</label><br>'.
                    '<input type="radio" name="Status" value="shipped"><label>SHIPPED</label><br>'.
                    '<input type="radio" name="Status" value="delivered"><label>DELIVERED</label><br>';
                break;
        }
            echo '<label> UserID: '.$orderlist["UserID"].' </label>'.
            '<br><label> AddressID: '.$orderlist["AddressID"].' </label>'.
            '<hr /><h3>Shipping Label</h3>'.
            '<br/><label>'.$user["Username"].'</label>'.
            '<br/><label>'.$address["Street"].'</label>'.
            '<br/><label>'.$address["City"].'</label>'.
            '<br/><label>'.$address["State"].'</label>'.
            '<br/><label>'.$address["Zip"].'</label>'.
            '<br/><label>'.$address["Country"].'</label>'.
            '<hr /><label>'.$user["Email"].'</label>'.
            '<hr /><h3>Products</h3>';
        while($product = $products->fetch()) {
            echo '<br/><label>'.$product["ProductID"].' - '.$product["Name"].'</label>';
        }
        echo '<hr /><input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="./admin.php" class="cancel">Cancel</a></div>';
    }  else if (!isset($_GET['action'])) {
        // unknown GET action
        header('Location: ./admin.php');
    }
} else if(isset($_POST['OrderID']) && isset($_POST['Status']) && isset($_POST['UserID']) && isset($_POST['AddressID']) ||
    isset($_POST['OrderID']) && isset($_POST['Status'])) {
    // Incoming update action from our form
    global $db;
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE invoice SET '. mapped_implode('",', $_POST, '="').'" WHERE OrderID = '.$_POST['OrderID']);
    header('Location: ./admin.php');
}
?>
</body>
</html>

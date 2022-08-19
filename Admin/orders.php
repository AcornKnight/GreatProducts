<?php
      require_once('../Utils/settings.php');
      require_once('../Utils/utils.php');
      // we only want admins doing admin functions
      guard("admin");

      $orders = $db->query('SELECT * FROM Invoice');

?>

<!DOCTYPE html>
<!-- Admin CRUD support file for our Great products database. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Admin Orders CRUD</title>
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
            echo '<a href="./admin.php"><i class="fas fa-ad"></i>Admin</a>';
        }
        ?>
        <a href="../User/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../Shop/cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
        <a href="../User/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>

<div>
    <h3>Orders:</h3>
    <table>
        <?php
            while($order=$orders->fetch()) {
                echo '<tr>';
                    echo '<td>';
                        echo '<td>'.$order['OrderID'].'</td>';
                        echo '<td>'.$order['Status'].'</td>';
                        echo '<td>'.$order['AddressID'].'</td>';
                        echo '<td><a href="./orderutil.php?action=orderupdate&OrderID='.$order['OrderID'].'">UPDATE</a></td>';
                        echo '<td><a href="./orderutil.php?action=orderdelete&OrderID='.$order['OrderID'].'">DELETE</a></td>';
                    echo '</td>';
                echo '</tr>';
            }
        ?>
    </table>
</div>
</body>
</html>

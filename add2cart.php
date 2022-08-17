<?php
require_once('settings.php');
if(isset($_GET) && isset($_GET['ProductID'])) {
    echo "work to do";
    if (isset($_SESSION) && isset($_SESSION['id'])) {
        global $db;
        global $user;
        echo '<br/>user:<br/>';
        print_r($user);
        echo '<br/>session:<br/>';
        print_r($_SESSION);
        $order = null;
        $cart = $db->query('Select OrderID FROM invoice WHERE UserID=' . $_SESSION['id'] . ' AND Status = "cart"');
        if ($cart->rowCount() < 1) {
            // We need to create a new order for this user's cart first
            $addresses = $db->query('SELECT * FROM address WHERE UserID = ' . $_SESSION['id']);
            if ($addresses->rowCount() < 1) {
                echo '<h2 style={color:#ff0000;}> ERROR - No shipping addresses defined in your profile</h2>';
                echo '<a href="profile.php">Edit your profile</a>';
            }
            echo '<hr /><h3>Pick shipping address</h3>';
            echo '<form action=add2cart.php method="post">';
            while ($address = $addresses->fetch()) {
                echo '<input type="radio" name="AddressID" value=' . $address["AddressID"] . '>';
                echo '<label>' . implode(", ", $address) . '</label><br>';
            }
            echo '<input type="hidden" name="ProductID" value='.$_GET['ProductID'].'>';
            echo '<input type="submit" value="Create Cart" class="create">';
            echo '</form>';

        } else {
            //User has an existing shopping cart order to add this item to
            $order = $cart->fetch();
            // Only add to the cart if we successfully have an order
            if ($order) {
                $basket = $db->query('SELECT * from productorder WHERE OrderID = "'. $order['OrderID'] .'" AND ProductID = "'.$_GET['ProductID'].'"');
                if($basket->rowCount() < 1) {
                    // not already in basket, add to cart
                    $db->exec('INSERT INTO productorder (`ProductID`, `OrderID`) VALUES ("' . $_GET['ProductID'] . '","' . $order['OrderID'] . '")');
                } else {
                    // already in the basket, update the count
                    $basket = $basket->fetch();
                    $basket["Count"] += 1;
                    $db->exec('UPDATE productorder SET Count = "'. $basket["Count"] .'" WHERE ProductID = "'.$basket["ProductID"].'" AND OrderID = "'.$basket["OrderID"].'"' );
                }
            }
            header('location: index.php');
        }
    }
} else if(isset($_POST) && isset($_POST["AddressID"]) && isset($_POST["ProductID"]) && isset($_SESSION) && isset($_SESSION['id'])) {
    global $db;
    $order = $db->exec('INSERT INTO invoice (`Status`, `UserID`, `AddressID`) VALUES ("cart", "'.$_SESSION['id'].'", "'.$_POST["AddressID"].'")');
    // Only add to the cart if we successfully have an order
    if ($order) {
        $cart = $db->query('Select OrderID FROM invoice WHERE UserID=' . $_SESSION['id'] . ' AND Status = "cart"');
        $cart = $cart->fetch();
        $basket = $db->query('SELECT * from productorder WHERE OrderID = "'. $cart['OrderID'] .'" AND ProductID = "'.$_POST['ProductID'].'"');
        if($basket->rowCount() < 1) {
            // not already in basket, add to cart
            $db->exec('INSERT INTO productorder (`ProductID`, `OrderID`) VALUES ("' . $_POST['ProductID'] . '","' . $cart['OrderID'] . '")');
        } else {
            // already in the basket, update the count
            $basket = $basket->fetch();
            $basket["Count"] += 1;
            $db->exec('UPDATE productorder SET Count = "'. $basket["Count"] .'" WHERE ProductID = "'.$basket["ProductID"].'" AND OrderID = "'.$basket["OrderID"].'"' );
        }
    }
    header('location: index.php');
} else {
    echo "no product to add to cart";
    header('location: index.php');
}

?>
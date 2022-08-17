<?php
require_once('settings.php');
if(isset($_GET) && isset($_GET['ProductID'])) {
    echo "work to do";
    if(isset($_SESSION) && isset($_SESSION['id'])) {
        global $db;
        global $user;
        echo '<br/>user:<br/>';
        print_r($user);
        echo '<br/>session:<br/>';
        print_r($_SESSION);
        $order =  null;
        $cart = $db->query('Select OrderID FROM invoice WHERE UserID='.$_SESSION['id'].' AND Status = "cart"');
        if($cart->rowCount() < 1) {
            // We need to create a new order for this user's cart first

        } else {
            //User has an existing shopping cart order to add this item to
            $order = $cart->fetch();
        }
        $db->query('INSERT INTO productorder (`ProductID`, `OrderID`) VALUES ("'.$_GET['ProductID'].'","'.$order.'")');
    }
} else {
    echo "no product to add to cart";
}

?>
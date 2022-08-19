<?php require_once('./settings.php'); ?>
    <!DOCTYPE html>
    <!-- Our cart page. -->
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
            echo '<a href="./index.php"><i class="fas fa-archive"></i>Main</a>';
            if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
              echo '<a href="./Admin/admin.php"><i class="fas fa-ad"></i>Admin</a>';
            }
            echo '<a href="./User/profile.php?UserID='.$_SESSION['id'].'">Profile</a><br/>';
            echo '<a href="./Shop/cart.php"><i class="fas fa-cart-plus"></i>Cart</a>';
            echo '<a href="./User/logout.php">Logout</a><br/>';
        } else {
            echo '<a href="./User/login.php">Login</a><br/>';
            echo '<a href="./User/signup.php">Sign up</a><br/>';
        }
        echo '<hr />';
        ?>
    </div>
</nav>

<?php

global $db;

if (isset($_POST) && isset($_POST["OrderID"])) {
    // User placed order, update order and product counts
    $db->exec('UPDATE invoice SET status = "ordered" WHERE OrderID = ' . $_POST["OrderID"]);
    $products = $db->query('SELECT ProductID, count from products WHERE ProductID in (SELECT ProductID from productorder WHERE OrderID = '.$_POST["OrderID"].')');
    while($product = $products->fetch()){
        $qty = $db->query('SELECT Count FROM productorder WHERE OrderID = "'.$_POST["OrderID"].'" AND ProductID = "'.$product["ProductID"].'"');
        $qty = $qty->fetch();
        $product["count"] -= $qty["Count"];
        $db->exec('UPDATE products SET count = "'.$product["count"].'" WHERE ProductID = '.$product['ProductID']);
    }
    header('Location: ./User/profile.php');
} else if(isset($_GET)) {
    // User wants to see their cart
    $cart = $db->query('SELECT OrderID from invoice WHERE UserID = ' . $_SESSION["id"] . ' AND Status = "cart"');
    if ($cart->rowCount() > 0) {
        $cart = $cart->fetch();
        $products = $db->query('SELECT * from products WHERE ProductID in (SELECT ProductID from productorder WHERE OrderID = ' . $cart["OrderID"] . ')');
        echo '<table>';
        echo '<tr><th>Name</th><th>Quantity</th><th>Cost</th></tr>';
        while ($product = $products->fetch()) {
            $qty = $db->query('SELECT Count FROM productorder WHERE OrderID = "'.$cart["OrderID"].'" AND ProductID = "'.$product["ProductID"].'"');
            $qty = $qty->fetch();
            echo '<tr>' .
                '<td>' . $product["Name"] . '</td>' .
                '<td>' . $qty["Count"] . '</td>' .
                '<td>' . $product["Cost"] . '</td>' .
                '</tr>';
        }
        echo '</table><hr />';
        echo '<form action=cart.php method="post">' .
            '<input type="hidden" name="OrderID" value="'. $cart["OrderID"] .'" required>'.
            '<input type="submit" value="Checkout" class="create">' .
            '</form>';


    }

} else {
    echo 'nothing to do';
}

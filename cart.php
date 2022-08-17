<?php require_once('settings.php'); ?>
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

global $db;

if (isset($_POST) && isset($_POST["OrderID"])) {
    $db->exec('UPDATE invoice SET status = "ordered" WHERE OrderID = ' . $_POST["OrderID"]);
    // TODO need to update product counts
    header('Location: profile.php');
} else if(isset($_GET)) {
    $cart = $db->query('SELECT OrderID from invoice WHERE UserID = ' . $_SESSION["id"] . ' AND Status = "cart"');
    if ($cart->rowCount() > 0) {
        $cart = $cart->fetch();
        $products = $db->query('SELECT * from products WHERE ProductID in (SELECT ProductID from productorder WHERE OrderID = ' . $cart["OrderID"] . ')');
        echo '<table>';
        echo '<tr><th>Name</th><th>Cost</th></tr>';
        while ($product = $products->fetch()) {
            echo '<tr>' .
                '<td>' . $product["Name"] . '</td>' .
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

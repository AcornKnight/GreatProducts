<?php
require_once('settings.php');

//print_r($_GET);
$prod_id = $_GET['ProductID'];
if($prod_id) {
    $p = $db->query('SELECT * FROM products WHERE ProductID =' . $_GET['ProductID']);
    $product = $p->fetch();
    if($product) {
        echo '<h3>' . $product["Name"] . '</h3>';
        echo '<hr /><p>' . $product["Details"] . '</p>';
        echo '<hr /><h3>' . $product["Cost"] . '</h3>';
        if (isset($_SESSION['id'])) {
            echo '<form action="add2cart.php">' .
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


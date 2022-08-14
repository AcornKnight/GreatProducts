<?php
require_once('GreatProducts/settings.php');
require_once('GreatProducts/lib/mysql.php');

print_r($_GET);
$prod_id = $_GET['ProductID'];
if($prod_id) {
    $p = $db->query('SELECT * FROM products WHERE ProductID =' . $_GET['ProductID']);
    $product = $p->fetch();
    print_r($product);
    echo '<h3>'.$product["Name"].'</h3>';
    echo '<hr /><p>'.$product["Details"].'</p>';
    echo '<hr /><h3>'.$product["Cost"].'</h3>';
    if(true) {
        echo '<h1>HOwdy</h1><form action="add2cart.php?ProductID="'.$prod_id.
            '<input type="submit" value="Add to Cart">
        </form>';
    }
} else {
    echo '<script type=javascript>alert("ProductID not found");</script>';
}

echo '<form action="/index.php"><input type="submit" value="CLOSE"></form>';


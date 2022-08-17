<!DOCTYPE html>
<!-- Admin CRUD support file for our Great products database. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Admin CRUD</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Great Products</h1>
      <a href="index.php"><i class="fas fa-archive"></i>Main</a>
      <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
      <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>
<?php
require_once('settings.php');
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
echo '<hr/>GET';
print_r($_GET);
echo '<hr/>POST';
print_r($_POST);
echo '<hr/>IMPLODE';
print_r(implode(',', $_POST));
echo '<hr/>';

// USERS CRUD BELOW
if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "delete") {
        global $db;
        $db->query('DELETE FROM User where UserID = ' . $_GET['UserID']);
        header('Location: admin.php');
    } else if ($_GET['action'] == "userupdate") {
        global $db;
        $userlist = $db->query('SELECT * FROM User WHERE UserID = '.$_GET['UserID']);
        $users = $userlist->fetch();

        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="UserID" placeholder="UserID" id="UserID" value="'. $_GET['UserID'] .'" required>'.
            '<label>Admin<label/>'.
            '<input type="text" name="Admin" placeholder="0 for no, 1 for yes" id="Admin" required value="'.$users["Admin"].'">'.
            '<label>Username</label>'.
            '<input type="text" name="Username" placeholder="Username" id="Username" required value="'.$users["Username"].'">'.
            '<label>Userpass</label>'.
            '<input type="text" name="Userpass" placeholder="Password" id="Userpass" required value="'.$users["Userpass"].'">'.
            '<label>Email</label>'.
            '<input type="text" name="Email" placeholder="Email@email.com" id="Email" required value="'.$users["Email"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else if ($_GET['action'] == "usercreate") {
        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
            '<label>Admin<label/>'.
            '<input type="text" name="Admin" placeholder="Admin" id="Admin" required>'.
            '<label>Username</label>'.
            '<input type="text" name="Username" placeholder="Username" id="username" required>'.
            '<label>Userpass</label>'.
            '<input type="text" name="Userpass" placeholder="Userpass" id="Userpass" required>'.
            '<label>Email</label>'.
            '<input type="text" name="Email" placeholder="Email" id="Email" required>'.
            '<input type="submit" value="Add" class="create">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else {
        // unknown GET action
        header('Location: admin.php');
    }
} else if(isset($_POST['UserID']) && isset($_POST['Admin']) && isset($_POST['Username']) && isset($_POST['Userpass']) && isset($_POST['Email'])) {
    // Incoming update action from our form
    global $db;
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE User SET '. mapped_implode('",', $_POST, '="').'" WHERE UserID = '.$_POST['UserID']);
    header('Location: admin.php');
} else if(isset($_POST['Admin']) && isset($_POST['Username']) && isset($_POST['Userpass']) && isset($_POST['Email'])) {
    // Incoming create action from our form
    global $db;
    $db->exec('INSERT INTO User (`UserID`,`Admin`, `Username`, `Userpass`, `Email`) VALUES ("'.$_SESSION['id'].'","' .implode('","', $_POST).'")');
    header('Location: admin.php');
} else {
    // nothing to do, sending back to profile screen
    header('Location: admin.php');
}

// CATEGORY CRUD BELOW
if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "categorydelete") {
        global $db;
        $db->query('DELETE FROM Category where CatID = ' . $_GET['CatID']);
        header('Location: admin.php');
    } else if ($_GET['action'] == "categoryupdate") {
        global $db;
        $categorylist = $db->query('SELECT * FROM Category WHERE CatID = '.$_GET['CatID']);
        $category = $categorylist->fetch();

        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="CatID" placeholder="CatID" id="CatID" value="'. $_GET['CatID'] .'" required>'.
            '<label>Category Name<label/>'.
            '<input type="text" name="CatName" placeholder="CatName" id="CatName" required value="'.$category["CatName"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else if ($_GET['action'] == "create") {
        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
            '<label>Category Name<label/>'.
            '<input type="text" name="CatName" placeholder="CatName" id="CatName" required>'.
            '<input type="submit" value="Add" class="create">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else {
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
    $db->exec('INSERT INTO Category (`CatID`,`CatName`) VALUES ("'.$_SESSION['id'].'","' .implode('","', $_POST).'")');
    header('Location: admin.php');
} else {
    // nothing to do, sending back to profile screen
    header('Location: admin.php');
}

// PRODUCT CRUD BELOW
if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "productdelete") {
        global $db;
        $db->query('DELETE FROM Products where ProductID = ' . $_GET['ProductID']);
        header('Location: profile.php');
    } else if ($_GET['action'] == "productupdate") {
        global $db;
        $productlist = $db->query('SELECT * FROM Products WHERE ProductID = '.$_GET['ProductID']);
        $products = $productlist->fetch();

        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="ProductID" placeholder="ProductID" id="ProductID" value="'. $_GET['ProductID'] .'" required>'.
            '<label>Name<label/>'.
            '<input type="text" name="Name" placeholder="Name" id="Name" required value="'.$products["Name"].'">'.
            '<label>Cost</label>'.
            '<input type="text" name="Cost" placeholder="Cost" id="Cost" required value="'.$products["Cost"].'">'.
            '<label>Details</label>'.
            '<input type="text" name="Details" placeholder="Details" id="Details" required value="'.$products["Details"].'">'.
            '<label>Count</label>'.
            '<input type="text" name="Count" placeholder="count" id="Count" required value="'.$products["Count"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else if ($_GET['action'] == "create") {
        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
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
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    } else {
        // unknown GET action
        header('Location: admin.php');
    }
} else if(isset($_POST['ProductID']) && isset($_POST['Name']) && isset($_POST['Cost']) && isset($_POST['Details']) && isset($_POST['Count'])) {
    // Incoming update action from our form
    global $db;
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE Product SET '. mapped_implode('",', $_POST, '="').'" WHERE ProductID = '.$_POST['ProductID']);
    header('Location: admin.php');
} else if(isset($_POST['Name']) && isset($_POST['Cost']) && isset($_POST['Details']) && isset($_POST['Count'])) {
    // Incoming create action from our form
    global $db;
    $db->exec('INSERT INTO Products (`ProductID`,`Name`, `Cost`, `Details`, `Count`) VALUES ("'.$_SESSION['id'].'","' .implode('","', $_POST).'")');
    header('Location: admin.php');
} else {
    // nothing to do, sending back to admin screen
    header('Location: admin.php');
}

// Order UD BELOW
if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "orderdelete") {
        global $db;
        $db->query('DELETE FROM invoice where OrderID = ' . $_GET['OrderID']);
        header('Location: admin.php');
    } else if ($_GET['action'] == "orderupdate") {
        global $db;
        $order = $db->query('SELECT * FROM invoice WHERE OrderID = '.$_GET['OrderID']);
        $orderlist = $order->fetch();

        echo '<div class="address">';
        echo '<form action="crud.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="OrderID" placeholder="OrderID" id="OrderID" value="'. $_GET['OrderID'] .'" required>'.
            '<label>Status<label/>'.
            '<input type="text" name="Status" placeholder="Status" id="Status" required value="'.$orderlist["Status"].'">'.
            '<label>UserID</label>'.
            '<input type="text" name="UserID" placeholder="UserID" id="UserID" required value="'.$orderlist["UserID"].'">'.
            '<label>AddressID</label>'.
            '<input type="text" name="AddressID" placeholder="AddressID" id="AddressID" required value="'.$AddressID["AddressID"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="admin.php" class="cancel">Cancel</a></div>';
    }  else {
        // unknown GET action
        header('Location: admin.php');
    }
} else if(isset($_POST['OrderID']) && isset($_POST['Status']) && isset($_POST['UserID']) && isset($_POST['AddressID'])) {
    // Incoming update action from our form
    global $db;
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE invoice SET '. mapped_implode('",', $_POST, '="').'" WHERE OrderID = '.$_POST['OrderID']);
    header('Location: profile.php');
}  else {
    // nothing to do, sending back to admin screen
    header('Location: admin.php');
}
?>
</body>
</html>

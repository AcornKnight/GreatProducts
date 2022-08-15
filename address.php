<!DOCTYPE html>
<!-- Address CRUD support file for our Great products database. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php
require_once('settings.php');
echo '<hr/>GET';
print_r($_GET);
echo '<hr/>POST';
print_r($_POST);
echo '<hr/>IMPLODE';
print_r(implode(',', $_POST));
echo '<hr/>';
if(isset($_GET['action'])) {
// Incoming action from the profile page
    if ($_GET['action'] == "delete") {
        global $db;
        $db->query('DELETE FROM Address where AddressID = ' . $_GET['AddressID']);
        header('Location: profile.php');
    } else if ($_GET['action'] == "update") {
        global $db;
        $address = $db->query('SELECT * FROM Address WHERE AddressID = '.$_GET['AddressID']);
        $address = $address->fetch();

        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="AddressID" placeholder="AddressID" id="AddressID" value="'. $_GET['AddressID'] .'" required>'.
            '<label>Street<label/>'.
            '<input type="text" name="Street" placeholder="Street" id="Street" required value="'.$address["Street"].'">'.
            '<label>City</label>'.
            '<input type="text" name="City" placeholder="City" id="City" required value="'.$address["City"].'">'.
            '<label>State</label>'.
            '<input type="text" name="State" placeholder="State" id="State" required value="'.$address["State"].'">'.
            '<label>Zip</label>'.
            '<input type="text" name="Zip" placeholder="Zip" id="Zip" required value="'.$address["Zip"].'">'.
            '<label>Country</label>'.
            '<input type="text" name="Country" placeholder="Country" id="Country" required value="'.$address["Country"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="profile.php" class="cancel">Cancel</a></div>';
    } else if ($_GET['action'] == "create") {
        echo '<div class="address">';
        echo '<form action="address.php" method="post" class="AddressForm">'.
            '<label>Street<label/>'.
            '<input type="text" name="Street" placeholder="Street" id="Street" required>'.
            '<label>City</label>'.
            '<input type="text" name="City" placeholder="City" id="City" required>'.
            '<label>State</label>'.
            '<input type="text" name="State" placeholder="State" id="State" required>'.
            '<label>Zip</label>'.
            '<input type="text" name="Zip" placeholder="Zip" id="Zip" required>'.
            '<label>Country</label>'.
            '<input type="text" name="Country" placeholder="Country" id="Country" required>'.
            '<input type="submit" value="Add" class="create">'.
            '</form>';
        echo '<a href="profile.php" class="cancel">Cancel</a></div>';
    } else {
        // unknown GET action
//        header('Location: profile.php');
    }
} else if(isset($_POST['AddressID']) && isset($_POST['Street']) && isset($_POST['City']) && isset($_POST['State']) && isset($_POST['Zip']) && isset($_POST['Country'])) {
// Incoming update action from our form
    global $db;
//    $db->execute('UPDATE Address SET ("Street", "City", "State", "Zip", "Country") VALUES ('.
//        $_POST['Street'].','.
//        $_POST['City'].','.
//        $_POST['State'].','.
//        $_POST['Zip'].','.
//        $_POST['Country'].','.
//        ') WHERE AddressID='.$_POST['AddressID']);
//    $db->commit();
    $db->exec('UPDATE address (`UserID`,`AddressID`,`Street`, `City`, `State`, `Zip`, `Country`) VALUES ("'.$_SESSION['id'].'","' .implode('","', $_POST).'") WHERE AddressID = '.$_POST['AddressID']);
} else if(isset($_POST['Street']) && isset($_POST['City']) && isset($_POST['State']) && isset($_POST['Zip']) && isset($_POST['Country'])) {
// Incoming create action from our form
    global $db;
//    $db->exec('INSERT INTO address (`Street`, `City`, `State`, `Zip`, `Country`) VALUES ('.
//        '`'.$_POST['Street'].'`,`'.
//        $_POST['City'].'`,`'.
//        $_POST['State'].'`,`'.
//        $_POST['Zip'].'`,`'.
//        $_POST['Country'].'`)');
    $db->exec('INSERT INTO address (`UserID`,`Street`, `City`, `State`, `Zip`, `Country`) VALUES ("'.$_SESSION['id'].'","' .implode('","', $_POST).'")');
} else {
    // nothing to do, sending back to profile screen
//    header('Location: profile.php');
}
?>
</body>
</html>

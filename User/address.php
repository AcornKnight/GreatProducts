<!DOCTYPE html>
<!-- Address CRUD support file for our Great products database. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Address</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Great Products</h1>
      <a href="./index.php"><i class="fas fa-archive"></i>Main</a>
      <a href="./User/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
      <a href="./User/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
  </nav>
<?php
require_once(__DIR__.'/../Utils/settings.php');
require_once(__DIR__.'/../Utils/utils.php');
guard("user");

echo '<hr/>';
if(isset($_GET['action'])) {
// Incoming action from the profile page
    if ($_GET['action'] == "delete") {
        $db->query('DELETE FROM Address where AddressID = ' . $_GET['AddressID']);
        header('Location: ./profile.php');
    } else if ($_GET['action'] == "update") {
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
        echo '<a href="./User/profile.php" class="cancel">Cancel</a></div>';
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
        echo '<a href="./User/profile.php" class="cancel">Cancel</a></div>';
    } else {
        // unknown GET action
        header('Location: ./profile.php');
    }
} else if(isset($_POST['AddressID']) && isset($_POST['Street']) && isset($_POST['City']) && isset($_POST['State']) && isset($_POST['Zip']) && isset($_POST['Country'])) {
    // Incoming update action from our form
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE address SET '. mapped_implode('",', $_POST, '="').'" WHERE AddressID = '.$_POST['AddressID']);
    header('Location: ./profile.php');
} else if(isset($_POST['Street']) && isset($_POST['City']) && isset($_POST['State']) && isset($_POST['Zip']) && isset($_POST['Country'])) {
    // Incoming create action from our form
    $db->exec('INSERT INTO address (`UserID`,`Street`, `City`, `State`, `Zip`, `Country`) VALUES ("'.$_SESSION['id'].'","' .implode('","', $_POST).'")');
    header('Location: ./profile.php');
} else {
    // nothing to do, sending back to profile screen
    header('Location: ./profile.php');
}
?>
</body>
</html>

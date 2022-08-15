<?php
require_once('settings.php');

if(isset($_GET['action'])) {
// Incoming action from the profile page
    if ($_GET['action'] == "delete") {
        global $db;
        $db->query('DELETE FROM Address where AddressID = ' . $_GET['AddressID']);
        header('Location: profile.php');
    } else if ($_GET['action'] == "update") {
        echo '<form action="address.php" mehod="post">'.
            '<input type="hidden" name="AddressID" placeholder="AddressID" id="AddressID" value="'. $_GET['AddressID'] .'" required>'.
            '<label>Street</label>'.
            '<input type="text" name="Street" placeholder="Street" id="Street" required>'.
            '<label>City</label>'.
            '<input type="text" name="City" placeholder="City" id="City" required>'.
            '<label>State</label>'.
            '<input type="text" name="State" placeholder="State" id="State" required>'.
            '<label>Zip</label>'.
            '<input type="text" name="Zip" placeholder="Zip" id="Zip" required>'.
            '<label>Country</label>'.
            '<input type="text" name="Country" placeholder="Country" id="Country" required>'.
            '<input type="submit" value="Update">'.
            '</form>';
        echo '<a href="profile.php">Cancel</a>';
    } else if ($_GET['action'] == "create") {
        echo '<form action="address.php" method="post">'.
            '<label>Street</label>'.
            '<input type="text" name="Street" placeholder="Street" id="Street" required>'.
            '<label>City</label>'.
            '<input type="text" name="City" placeholder="City" id="City" required>'.
            '<label>State</label>'.
            '<input type="text" name="State" placeholder="State" id="State" required>'.
            '<label>Zip</label>'.
            '<input type="text" name="Zip" placeholder="Zip" id="Zip" required>'.
            '<label>Country</label>'.
            '<input type="text" name="Country" placeholder="Country" id="Country" required>'.
            '</form>';
        echo '<a href="profile.php">Cancel</a>';
    } else {
        // unknown GET action
        header('Location: profile.php');
    }
} else if(isset($_POST['action'])) {
// Incoming action from one of our forms
// if $_POST['AddressID'] we have an update, otherwise it is a create action

} else {
    // nothing to do, sending back to profile screen
    header('Location: profile.php');
}
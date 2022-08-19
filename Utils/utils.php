<?php
require_once __DIR__.'./settings.php';

// Doing the database connection in a single place
$con = mysqli_connect($host, $username, $password, $dbname);
if ( mysqli_connect_errno() ) {
    // If there is an error with the connection, stop the script and display the error.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Take our input array, like from $_POST and make it a single string of a series of key=value
// handy for doing things like DB updates with minimal massaging of the input data
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

// Utility function to help us verify user permission level for requested feature/action
function guard($required_user_level) {
    switch($required_user_level) {
        case "admin":
            // admin only, redirect to main page if not an admin
            if(isset($_SESSION) && isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"]) {
                return true;
            }
            header('location: ../index.php');
            break;
        case "user":
            // need a logged in user, if not, redirect to login page
            if(isset($_SESSION) && isset($_SESSION["loggedin"]) && $_SESSION["loggedin"]) {
                return true;
            }
            header('location: ../user/login.php');
            break;
        case "guest":
            // Nothing to check for
            return true;
        default:
            // unknown user permission level
            header('location: ../index.php');
    }
    // Should never reach here. Return false just in case so user is not granted rights to something we don't have logic to cover
    return false;
}
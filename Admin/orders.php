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
        <?php
        if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
            echo '<a href="admin.php"><i class="fas fa-ad"></i>Admin</a>';
        }
        ?>
        <a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
<?php
require_once('../utils/settings.php');
require_once('../utils/utils.php');

guard("admin");
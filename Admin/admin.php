<?php
  require_once(__DIR__.'/../Utils/settings.php');
  require_once(__DIR__.'/../Utils/utils.php');

// we only want admins doing admin functions
guard("admin");

    // We don't have the password or email info stored in sessions so instead we can get the results from the database.
    $stmt = $con->prepare('SELECT userpass, Email FROM user WHERE UserID = ?');
    // In this case we can use the account ID to get the account info.
    $stmt->bind_param('i', $_SESSION['id']);
    $stmt->execute();
    $stmt->bind_result($userpass, $Email);
    $stmt->fetch();
    $stmt->close();

    $userlist = $db->query('SELECT * FROM user');
//    $addresses = $addresses->fetch();
    $orders = $db->query('SELECT * FROM Invoice');
//    $orders = $orders->fetch();
    $categorys = $db->query('SELECT * FROM category');
    // Query for Products
    $products = $db->query('SELECT * FROM products');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Administrator Area</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
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
				<a href="../User/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../Shop/cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
				<a href="../User/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Administrator Page</h2>
      <div>
          <h3><a href="./users.php"> Users</a></h3>
      </div>
      <div>
          <h3><a href="./orders.php"> Orders</a></h3>
      </div>
      <div>
          <h3><a href="./products.php"> Products</a></h3>
      </div>
      <div>
          <h3><a href="./categories.php"> Categories</a></h3>
      </div>
		</div>
	</body>
</html>

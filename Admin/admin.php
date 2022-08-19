<?php
  require_once(__DIR__.'/../Utils/settings.php');
  require_once(__DIR__.'/../Utils/utils.php');

// we only want admins doing admin functions
guard("admin");

  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['loggedin'])) {
	  header('Location: index.php');
	  exit;
    }
    global $host, $username, $password, $dbname;
    $con = mysqli_connect($host, $username, $password, $dbname);
    if (mysqli_connect_errno()) {
	     exit('Failed to connect to MySQL: ' . mysqli_connect_error());
       }
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
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Administrator Page</h2>
      <div>
          <h3>Users:</h3>
          <a href="crud.php?action=usercreate">ADD NEW USER</a>
              <table>
                    <?php
                        while($users=$userlist->fetch()) {
                            echo '<tr>';
                                echo '<td>'.$users['UserID'].'</td>';
                                echo '<td>'.$users['Admin'].'</td>';
                                echo '<td>'.$users['Username'].'</td>';
                                echo '<td>'.$users['Userpass'].'</td>';
                                echo '<td>'.$users['Email'].'</td>';
                                echo '<td><a href="crud.php?action=userupdate&UserID='.$users['UserID'].'">UPDATE</a></td>';
                                echo '<td><a href="crud.php?action=userdelete&UserID='.$users['UserID'].'">DELETE</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
          </div>
      <div>
          <h3>Categorys:</h3>
          <a href="crud.php?action=categorycreate">ADD NEW CATEGORY</a>
              <table>
                    <?php
                        while($category=$categorys->fetch()) {
                            echo '<tr>';
                                echo '<td>'.$category['CatID'].'</td>';
                                echo '<td>'.$category['CatName'].'</td>';
                                echo '<td><a href="crud.php?action=categoryupdate&CatID='.$category['CatID'].'">UPDATE</a></td>';
                                echo '<td><a href="crud.php?action=categorydelete&CatID='.$category['CatID'].'">DELETE</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
        </div>
        <div>
              <h3>Products:</h3>
              <a href="crud.php?action=productcreate">ADD NEW PRODUCT</a>
                  <table>
                        <?php
                            while($product=$products->fetch()) {
                                echo '<tr>';
                                    echo '<td>'.$product['ProductID'].'</td>';
                                    echo '<td>'.$product['Name'].'</td>';
                                    echo '<td>'.$product['Cost'].'</td>';
                                    echo '<td>'.$product['Details'].'</td>';
                                    echo '<td>'.$product['Count'].'</td>';
                                    echo '<td><a href="crud.php?action=productupdate&ProductID='.$product['ProductID'].'">UPDATE</a></td>';
                                    echo '<td><a href="crud.php?action=productdelete&ProductID='.$product['ProductID'].'">DELETE</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
            </div>
            <div>
                <h3>Orders:</h3>
                <table>
                    <?php
                        while($order=$orders->fetch()) {
                            echo '<tr>';
                                echo '<td>';
                                    echo '<td>'.$order['OrderID'].'</td>';
                                    echo '<td>'.$order['Status'].'</td>';
                                    echo '<td>'.$order['AddressID'].'</td>';
                                    echo '<td><a href="crud.php?action=orderupdate&OrderID='.$order['OrderID'].'">UPDATE</a></td>';
                                    echo '<td><a href="crud.php?action=orderdelete&OrderID='.$order['OrderID'].'">DELETE</a></td>';
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
		</div>
	</body>
</html>

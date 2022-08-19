<?php
  require_once(__DIR__.'/../Utils/settings.php');
  require_once(__DIR__.'/../Utils/utils.php');
  guard("admin");

  // If the user is not logged in redirect to the login page...
  if (!isset($_SESSION['loggedin'])) {
	  header('Location: ../index.php');
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

    $products = $db->query('SELECT * FROM products');

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Administrator Product Area</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Great Products</h1>
        <a href="../index.php"><i class="fas fa-archive"></i>Main</a>
        <?php
          if(isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'] == 1) {
            echo '<a href="../Admin/admin.php"><i class="fas fa-ad"></i>Admin</a>';
          }
         ?>
				<a href="../User/profile.php"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="../Shop/cart.php"><i class="fas fa-cart-plus"></i>Cart</a>
				<a href="../User/logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Administrator Products Page</h2>
      <div>
              <h3>Products:</h3>
              <a href="./productutil.php?action=productcreate">ADD NEW PRODUCT</a>
                  <table>
                        <tr><th>ID</th><th>Name</th><th>Cost</th><th>Details/th><th>Count</th><th>Update</th><th>Delete</th></th></tr>
                        <?php
                            while($product=$products->fetch()) {
                                echo '<tr>';
                                    echo '<td>'.$product['ProductID'].'</td>';
                                    echo '<td>'.$product['Name'].'</td>';
                                    echo '<td>'.$product['Cost'].'</td>';
                                    echo '<td>'.$product['Details'].'</td>';
                                    echo '<td>'.$product['Count'].'</td>';
                                    echo '<td><a href="./productutil.php?action=productupdate&ProductID='.$product['ProductID'].'">UPDATE</a></td>';
                                    echo '<td><a href="./productutil.php?action=productdelete&ProductID='.$product['ProductID'].'">DELETE</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
        </div>
      </body>
    </html>

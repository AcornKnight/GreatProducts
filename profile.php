<?php
require_once('settings.php');
  // We need to use sessions, so you should always start sessions using the below code.
//  session_start();
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

    $addresses = $db->query('SELECT * FROM Address WHERE UserID='.$_SESSION['id']);
//    $addresses = $addresses->fetch();
    $orders = $db->query('SELECT * FROM Invoice WHERE UserID='.$_SESSION['id']);
//    $orders = $orders->fetch();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Great Products</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a>
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$Email?></td>
					</tr>
				</table>
			</div>
            <div>
                <h3>Addresses:</h3>
                <a href="address.php?action=create">ADD NEW ADDRESS</a>
                <table>
                    <?php
                        while($address=$addresses->fetch()) {
                            echo '<tr>';
                                echo '<td>'.$address['Street'].'</td>';
                                echo '<td>'.$address['City'].'</td>';
                                echo '<td>'.$address['State'].'</td>';
                                echo '<td>'.$address['Zip'].'</td>';
                                echo '<td>'.$address['Country'].'</td>';
                                echo '<td><a href="address.php?action=update&AddressID='.$address['AddressID'].'">UPDATE</a></td>';
                                echo '<td><a href="address.php?action=delete&AddressID='.$address['AddressID'].'">DELETE</a></td>';
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
                                echo '</td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
            </div>
		</div>
	</body>
</html>

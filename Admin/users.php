<?php
      require_once('../Utils/settings.php');
      require_once('../Utils/utils.php');
// we only want admins doing admin functions
guard("admin");

    $userlist = $db->query('SELECT * FROM user');

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Administrator User Area</title>
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
			<h2>Administrator Page</h2>
      <div>
          <h3><a href="admin.php">Administration</a> Users:</h3><hr />
          <a href="../Admin/userutil.php?action=usercreate">ADD NEW USER</a>
              <table>
                    <?php
                        while($users=$userlist->fetch()) {
                            echo '<tr>';
                                echo '<td>'.$users['UserID'].'</td>';
                                echo '<td>'.$users['Admin'].'</td>';
                                echo '<td>'.$users['Username'].'</td>';
                                echo '<td>'.$users['Userpass'].'</td>';
                                echo '<td>'.$users['Email'].'</td>';
                                echo '<td><a href="../Admin/userutil.php?action=userupdate&UserID='.$users['UserID'].'">UPDATE</a></td>';
                                echo '<td><a href="../Admin/userutil.php?action=userdelete&UserID='.$users['UserID'].'">DELETE</a></td>';
                            echo '</tr>';
                        }
                    ?>
                </table>
          </div>

        </div>
      </body>
    </html>

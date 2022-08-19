<?php
      require_once('../Utils/settings.php');
      require_once('../Utils/utils.php');

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

    $userlist = $db->query('SELECT * FROM user');

?>

<!DOCTYPE html>
<!-- Admin CRUD support file for our Great products database. -->
<!-- Noah R Gestiehr. -->
<html>
<head>
    <meta charset="utf-8">
    <title>Admin User CRUD</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../style.css" rel="stylesheet" type="text/css">
</head>
<body class="loggedin">
  <nav class="navtop">
    <div>
      <h1>Great Products</h1>
      <a href="index.php"><i class="fas fa-archive"></i>Main</a>
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
<?php

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


// USERS CRUD BELOW
if(isset($_GET['action'])) {
// Incoming action from the admin page
    if ($_GET['action'] == "userdelete") {
        global $db;
        $db->query('DELETE FROM User where UserID = ' . $_GET['UserID']);
        header('Location: ../Admin/admin.php');
    } else if ($_GET['action'] == "userupdate") {
        global $db;
        $userlist = $db->query('SELECT * FROM User WHERE UserID = '.$_GET['UserID']);
        $users = $userlist->fetch();

        echo '<div class="address">';
        echo '<form action="../Admin/userutil.php" method="post" class="AddressForm">'.
            '<input type="hidden" name="UserID" placeholder="UserID" id="UserID" value="'. $_GET['UserID'] .'" required>'.
            '<label>Admin<label/>'.
            '<input type="text" name="Admin" placeholder="0 for no, 1 for yes" id="Admin" required value="'.$users["Admin"].'">'.
            '<label>Username</label>'.
            '<input type="text" name="Username" placeholder="Username" id="Username" required value="'.$users["Username"].'">'.
            '<label>Userpass</label>'.
            '<input type="text" name="Userpass" placeholder="Password" id="Userpass" required value="'.$users["Userpass"].'">'.
            '<label>Email</label>'.
            '<input type="text" name="Email" placeholder="Email@email.com" id="Email" required value="'.$users["Email"].'">'.
            '<input type="submit" value="Update" class="update">'.
            '</form>';
        echo '<a href="../Admin/admin.php" class="cancel">Cancel</a></div>';
    } else if ($_GET['action'] == "usercreate") {
        echo '<div class="address">';
        echo '<form action="../Admin/userutil.php" method="post" class="AddressForm">'.
            '<label>Admin<label/>'.
            '<input type="text" name="Admin" placeholder="Admin" id="Admin" required>'.
            '<label>Username</label>'.
            '<input type="text" name="Username" placeholder="Username" id="username" required>'.
            '<label>Userpass</label>'.
            '<input type="text" name="Userpass" placeholder="Userpass" id="Userpass" required>'.
            '<label>Email</label>'.
            '<input type="text" name="Email" placeholder="Email" id="Email" required>'.
            '<input type="submit" value="Add" class="create">'.
            '</form>';
        echo '<a href="../Admin/admin.php" class="cancel">Cancel</a></div>';
    } else if (!isset($_GET['action'])) {
        // unknown GET action
        header('Location: ../Admin/admin.php');
    }
} else if(isset($_POST['UserID']) && isset($_POST['Admin']) && isset($_POST['Username']) && isset($_POST['Userpass']) && isset($_POST['Email'])) {
    // Incoming update action from our form
    global $db;
    // the quotes are correct in the UPDATE SQL below. it wants:  ... SET key1="value1", key2="value2" WHERE ...
    // it throws a hissy (syntax error) when keys are quoted. It pukes on spaces in values when values are not quoted
    $db->exec('UPDATE User SET '. mapped_implode('",', $_POST, '="').'" WHERE UserID = '.$_POST['UserID']);
    header('Location: ../Admin/admin.php');
} else if(isset($_POST['Admin']) && isset($_POST['Username']) && isset($_POST['Userpass']) && isset($_POST['Email'])) {
    // Incoming create action from our form
    global $db;
    $db->exec('INSERT INTO User (`Admin`, `Username`, `Userpass`, `Email`) VALUES ("' .implode('","', $_POST).'")');
    header('Location: ../Admin/admin.php');
}
?>
  </body>
</html>

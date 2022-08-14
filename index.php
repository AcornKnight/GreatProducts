<?php
require_once('settings.php');

if($user) {
    echo 'Hello '.$user['Username'];
    echo '<a href="profile.php">Profile</a>';
    echo '<a href="logout.php">Logout</a>';
} else {
    echo '<a href="login.php">Login</a>';
}

// READ ALL
$products=$db->query('SELECT * FROM products');
echo '<table border="1">';
while($row=$products->fetch()){
//    print_r($row);
    echo '
        <tr>
            <td><a href="details.php?ProductID='.$row['ProductID'].'">'.$row['Name'].'</a></td>
            <td>'.$row['Cost'].'</td>
        </tr>
    </a>';
}
echo '</table >';
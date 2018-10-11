<?php
require '../includes/autoloader.php';
	//creating the instance of common html
$object = new CommonHtml();
$object->getLeftSection();//getting the left section 

echo '<div class="col-md-8">';
echo '<h3>List of Users</h3> <br>';
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Email</th>
                    </tr>
                </thead>';

    $table = 'users';
    $database = new DatabaseTable($pdo, $table);
    $users = $database->selectAll();

    foreach ($users as $user) {
        echo '<tr>';
        echo '<td>' . $user['firstname'] . '</td>';
        echo '<td>' . $user['lastname'] . '</td>';
        echo '<td>' . $user['email'] . '</td>';
        echo '<td><a class="btn btn-warning" style="float: right" href="edituser?id=' . $user['id'] . '">Edit</a></td>';
        echo '<td><form method="post" action="deleteuser">
                    <input type="hidden" name="id" value="' . $user['id'] . '" />
                    <input type="submit" class="btn btn-danger" name="submit" value="Delete" onclick="javascript:return confirm(\' are you sure you want to delete this ? \');"/>
                    </form></td>';
        echo '</tr>';
    }

    echo '</thead>';
    echo '</table>';

} else {
		//getting login form if session is unset
    $object = new CommonHtml();
    $object->getLoginForm();
}


echo '</div>';
?>


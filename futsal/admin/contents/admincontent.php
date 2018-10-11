<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

    echo'<div class="col-md-8">';
    echo '<h3>List of Admins</h3> <br>';
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
        echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>';

			$table='admins';
			$database=new DatabaseTable($pdo,$table);
			$admins = $database->selectAll();

			foreach ($admins as $admin) 
			{
				echo '<tr>';
                    echo '<td>' . $admin['username'] . '</td>';
                    echo '<td><a class="btn btn-warning" style="float: right" href="editadmin?id=' . $admin['id'] . '">Edit</a></td>';
                    echo '<td><form method="post" action="deleteadmin">
                    <input type="hidden" name="id" value="' . $admin['id'] . '" />
                    <input type="submit" class="btn btn-danger" name="submit" value="Delete" onclick="javascript:return confirm(\' are you sure you want to delete this ? \');"/>
                    </form></td>';
				echo '</tr>';
			}

			echo '</thead>';
			echo '</table>';

	}
	else 
	{
		//getting login form if session is unset
		$object=new CommonHtml();
		$object->getLoginForm();	
	}
	

echo'</div>';
?>


<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

    echo'<div class="col-md-8">';
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
    echo '<center><h2>Current Notices</h2></center>';
    echo '<center><a class="new" href="addnotice">Add Notices</a></center>';

        echo '
            <table class="table table-hover">
                <thead>
                    <tr>
						<th>Notice Id</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>';

			$table='notices';
            $database=new DatabaseTable($pdo,$table);
            /* showing the notices of only session set futsal */
            $notices = $database->selectMatchedColumnName('futsal_id', $_SESSION['id']);

			foreach ($notices as $notice) 
			{
				echo '<tr>';
					echo '<td>' . $notice['id'] . '</td>';
                    echo '<td><a class="btn btn-warning" style="float: right" href="editnotice?id=' . $notice['id'] . '">Edit</a></td>';
                    echo '<td><form method="post" action="deletenotice">
                    <input type="hidden" name="id" value="' . $notice['id'] . '" />
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


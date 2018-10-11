<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

    echo'<div class="col-md-8">';
    echo '<h3>List of Futsal</h3> <br>';
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
        echo '<center><a href="index.php?page=addfutsal">Add new Futsal</a></center>';

        echo '
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Futsal</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>';

			$table='futsals';
			$database=new DatabaseTable($pdo,$table);
			$futsals = $database->selectAll();

			foreach ($futsals as $futsal) 
			{
				echo '<tr>';
                    echo '<td>' . $futsal['name'] . '</td>';
                    echo '<td><a class="btn btn-warning" style="float: right" href="editfutsal?id=' . $futsal['id'] . '">Edit</a></td>';
                    echo '<td><form method="post" action="deletefutsal">
                    <input type="hidden" name="id" value="' . $futsal['id'] . '" />
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


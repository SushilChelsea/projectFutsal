<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

    echo'<div class="col-md-8">';
    echo '<h3>List of Bookings</h3> <br>';
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{

        echo '
            <table class="table table-hover">
                <thead>
                    <tr>
						<th>Booked By</th>
						<th>Date</th>
						<th>Time</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>';

			$table='bookings';
			$database=new DatabaseTable($pdo,$table);
			$bookings = $database->selectMatchedColumnName('futsal_id', $_SESSION['id']);
			// var_dump($bookings); die();

			foreach ($bookings as $booking) 
			{
				echo '<tr>';
					echo '<td>' . $booking['customer_name'] . '</td>';
					echo '<td>' . $booking['date'] . '</td>';
					echo '<td>' . $booking['timing'] . '</td>';
                    echo '<td><a class="btn btn-warning" style="float: right" href="editbooking?id=' . $booking['id'] . '">Edit</a></td>';
                    echo '<td><form method="post" action="deletebooking">
                    <input type="hidden" name="id" value="' . $booking['id'] . '" />
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


<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

	echo'<div class="col-md-8">';

	$table="bookings";
	$primaryKey="id";
	$database=new DatabaseTable($pdo,$table);


	if (isset($_POST['submit'])) 
	{
		$array = $_POST['booking'];
		$boolean=$database->update($array,$primaryKey);
		if($boolean)
		echo 'Booking Edited';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			$field='id';
            $value=$_GET['id'];
            $currentBooking=$database->selectUnique($field, $value);
            // var_dump(currentBooking); die();
?>


			<h2>Edit Booking</h2>
			<form action="" method="POST">
                <input type="hidden" class="form-control" name="booking[id]" value="<?php echo $currentBooking['id']; ?>">
				<input type="hidden" class="form-control" name="booking[futsal_id]" value="<?php echo $_SESSION['id']; ?>">
				<div class="form-group">
					<input type="text" class="form-control" name="booking[customer_name]" value="<?php echo $currentBooking['customer_name']; ?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="booking[timing]" value="<?php echo $currentBooking['timing']; ?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="booking[date]" value="<?php echo $currentBooking['date']; ?>">
				</div>
				
				<div class="text-center">
					<input type="submit" name="submit" value="Submit" class="btn btn-primary">
				</div>

			</form>
			

	<?php
		}

		else 
		{
			//getting login form if session is unset
			$object=new CommonHtml();
			$object->getLoginForm();
		}

	}
	


echo'</div>';
?>





<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

	echo'<div class="col-md-8">';

	$table="futsals";
	$primaryKey="id";
	$database=new DatabaseTable($pdo,$table);


	if (isset($_POST['submit'])) 
	{

		$array=$_POST['futsal'];
		$boolean=$database->update($array,$primaryKey);
		if($boolean)
		echo 'Account Edited';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			$field='id';
            $value=$_GET['id'];
            $currentFutsal=$database->selectUnique($field, $value);
            // var_dump(currentFutsal); die();
?>


			<h2>Edit Futsal</h2>
			<form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" class="form-control" name="futsal[id]" value="<?php echo $currentFutsal['id']; ?>">
				<input type="hidden" class="form-control" name="futsal[password]" value="<?php echo $currentFutsal['password']; ?>">
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[name]" value="<?php echo $currentFutsal['name']; ?>">
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="futsal[email]" value="<?php echo $currentFutsal['email']; ?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[telephone]" value="<?php echo $currentFutsal['telephone']; ?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[location]" value="<?php echo $currentFutsal['location']; ?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[city]" value="<?php echo $currentFutsal['city']; ?>">
				</div>
				<div class="form-group">
					<textarea class="form-control" name="futsal[description]" ><?php echo $currentFutsal['description']; ?></textarea>
				</div>
				<div class="form-group">
					<input type="file" class="form-control" name="image">
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





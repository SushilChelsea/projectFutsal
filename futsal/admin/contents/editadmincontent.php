<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

	echo'<div class="col-md-8">';

	$table="admins";
	$primaryKey="id";
	$database=new DatabaseTable($pdo,$table);


	if (isset($_POST['submit'])) 
	{

		$array=$_POST['account'];
		$boolean=$database->update($array,$primaryKey);
		if($boolean)
		echo 'Account Edited';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
			$field='id';
			$value=$_GET['id'];
			$currentAcc=$database->selectUnique($field, $value);
?>


			<h2>Edit Account</h2>

			<form action="" method="POST">

				<input type="hidden" name="account[id]" value="<?php echo $currentAcc['id']; ?>" />
                <div class="form-group">
					<label for="username">Username:</label>
					<input type="text" class="form-control" id="username" name="account[username]" value="<?php echo $currentAcc['username']; ?>">
				</div>

				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="account[password]" value="<?php echo $currentAcc['password']; ?>">
				</div>
                
				<div class="text-center">
				<input type="submit" class="btn btn-primary" name="submit" value="Save Account">
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





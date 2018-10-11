<?php
	require '../includes/autoloader.php';
	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 

	echo'<div class="col-md-8">';

	$table="users";
	$primaryKey="id";
	$database=new DatabaseTable($pdo,$table);


	if (isset($_POST['submit'])) 
	{

        $array=$_POST['account'];
		$boolean=$database->update($array,$primaryKey);
		if($boolean)
		echo '<h3 class="text-primary" style="margin-top: 20px; ">Account Edited <small> Thank You.<small></h3>';
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
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" id="first_name" name="account[firstname]" value="<?php echo $currentAcc['firstname']; ?>">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" id="last_name" name="account[lastname]" value="<?php echo $currentAcc['lastname']; ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="account[email]" value="<?php echo $currentAcc['email']; ?>">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control" id="pwd" name="account[password]" value="<?php echo $currentAcc['password']; ?>">
                </div>
                <div class="form-group">
                    <label for="sel1">Select Gender:</label>
                    <select class="form-control" id="sel1" name="account[gender]" >
                        <?php
                            $table = 'users';
                            $database = new DatabaseTable($pdo, $table);
                            $stmt = $database->selectAll();
                            foreach ($stmt as $row) {
                                if ($currentAcc['id'] == $row['id']) {
                                   if ($row['gender'] == "male") {
                                        echo '<option selected="selected" value="male">Male</option>';
                                        echo '<option  value="female">Female</option>';
                                    } else {
                                        echo '<option selected="selected" value="female">Female</option>';
                                        echo '<option  value="male">Male</option>';
                                    }
                                }
                            }

                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input type="text" class="form-control" id="address" name="account[location]" placeholder="Location eg: Baneswor" value="<?php echo $currentAcc['location']; ?>">
                    <br>
                    <input type="text" class="form-control" id="address" name="account[city]" placeholder="City" value="<?php echo $currentAcc['city']; ?>">
                </div>
                <div class="form-group text-center">
                    <input type="submit" class="btn btn-primary" name="submit" value="Edit User">
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





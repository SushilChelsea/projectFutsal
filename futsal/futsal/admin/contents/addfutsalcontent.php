<?php
	require '../includes/autoloader.php';

	//@creating the instance of common html
	$object=new CommonHtml();
    $object->getLeftSection();//@getting the left section 
    
	echo'<div class="col-md-8">';
	if (isset($_POST['submit'])) 
	{
		/* $_FILES is a global veriable 
		 * print_r(_FILES['image']);
		 * image is the name we provided on <input type="file" name="image">
		 * file has a array with key name, type, tmp_name, error and size
		 * to get value of one of thes key $_FILES['image'][key]
		 * $fileExt = explode('.' , $_FILES['image']['name']);	// gives file extension 
		 *	$fileName = current($fileExt);						// gives file name
		 * $file = $_FILES['image'];	
			echo $_FILES['image']['tmp_name']; die();
		*/
		$target_dir = "../../img/futsal/";
		$target_file = $target_dir . basename($_FILES["image"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}

		// Allow certain file formats
		if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif") {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
		}
		
		$array=$_POST['futsal'];
		$array['img'] = $_FILES['image']['name'];

		$table = 'futsals';
		$databaseTable=new DatabaseTable($pdo,$table);
		$boolean = $databaseTable->insert($array);
		if ($boolean) {
			echo "<script> alert('Futsal added'); </script>";
		}
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
		{
?>


			<h2>Add Futsal</h2>
			<form action="" method="POST" enctype="multipart/form-data">
				<input type="hidden" class="form-control" name="futsal[password]" value="futsal">
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[name]" placeholder="Futsal Name" required>
				</div>
				<div class="form-group">
					<input type="email" class="form-control" name="futsal[email]" placeholder="Futsal Email" required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[telephone]" pattern="[0-9]{9}" title="Nine digit land-line number" required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[location]" placeholder="Futsal Location" required>
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="futsal[city]" placeholder="City" required>
				</div>
				<div class="form-group">
					<textarea class="form-control" name="futsal[description]" placeholder="Description about the futsal" required></textarea>
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
			//@getting login form if session is unset
			$object=new CommonHtml();
			$object->getLoginForm();
		}

	}

	
echo'</div>';
?>
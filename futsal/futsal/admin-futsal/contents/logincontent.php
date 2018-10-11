<?php
    require '../includes/autoloader.php';

    
	$table="futsals";
	$database=new DatabaseTable($pdo,$table);
	
	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$futsal=$database->selectUnique('email', $email);

		//checking username and password of admins
		if ($_POST['email'] == $futsal['email'] && $_POST['password'] == $futsal['password']) 
		{
			$_SESSION['loggedin'] =true;
			$_SESSION['email']=$futsal['email'];
			$_SESSION['name'] = $futsal['name'];
			$_SESSION['id'] = $futsal['id'];
			$valid = true;	
		}	
		else {
			echo "<script> alert('Invalid email or password!'); </script>";
		}		
		
	}

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==true) {
		//creating common html object
		$object=new CommonHtml();
		$object->getLeftSection();

		echo'<section class="right">
				<h2>'.$_SESSION['name'].' you are now logged in</h2>
			</section>';
	}

	else 
	{
		// if session is unset get login form
		$object=new CommonHtml();
		$object->getLoginForm();
	
	}

?>
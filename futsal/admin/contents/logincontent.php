<?php
    require '../includes/autoloader.php';

    
	$table="admins";
	$database=new DatabaseTable($pdo,$table);
	
	if (isset($_POST['login'])) {
		$admins=$database->selectAll();
		$valid = false;
		foreach($admins as $row) {
			//checking username and password of admins
			if ($_POST['username'] == $row['username'] && $_POST['password'] == $row['password']) 
			{
				$_SESSION['loggedin'] =true;
				$_SESSION['username']=$row['username'];
                $valid = true;	
                break;
			}			
		}
		// valid is false print invalid usernam or password
		if(!$valid){	echo "<script> alert('Invalid username or password!'); </script>";	}		
	}

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] ==true) {
		//creating common html object
		$object=new CommonHtml();
		$object->getLeftSection();

		echo'<section class="right">
				<h2>'.ucfirst($_SESSION['username']).' you are now logged in</h2>
			</section>';
	}

	else 
	{
		// if session is unset get login form
		$object=new CommonHtml();
		$object->getLoginForm();
	
	}

?>
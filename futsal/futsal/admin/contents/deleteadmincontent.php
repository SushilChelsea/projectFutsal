<?php
	require '../includes/autoloader.php';

	//creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//getting the left section 
		
	echo'<div class="col-md-8">';
	$table='admins';
	$database=new DatabaseTable($pdo,$table);
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
	{
			$field='id';
			$value=$_POST['id'];
			$account=$database->delete($field,$value);
	}
	else 
	{
		//getting login form if session is unset
		$object=new CommonHtml();
		$object->getLoginForm();
	}
	

echo'</div>';
?>
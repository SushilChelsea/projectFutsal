<?php

  class Commonhtml
  {
  	function getLeftSection()
  	{
  		echo '<div class="col-md-4">
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation"><a href="index.php?page=admin">Admins</a></li>
						<li role="presentation"><a href="index.php?page=users">Users</a></li>
						<li role="presentation"><a href="futsal">Futsals</a></li>
						<li role="presentation"><a href="#">Bookings</a></li>
						<li role="presentation"><a href="login&logout=true">Logout</a></li>
					</ul>
				</div>';
  	}

  	function getLoginForm()
  	{
  		echo '
			<div class="row"> 
			<div class="col-md-3 col-center"></div>
			<div class="col-md-6"> 
			<h2 style="margin: 20px 2px 20px 2px; border-radius: 10px; text-align: center;">Log in</h2>
			<form action="index.php" method="post">
				<div class="form-group">
					<label for="username">Username:</label>
					<input type="text" class="form-control" id="username" name="username" required>
				</div>
				<div class="form-group">
					<label for="password">Password:</label>
					<input type="password" class="form-control" id="password" name="password" required>
				</div>
				<div class="text-center">
				<input type="submit" class="btn btn-primary" name="login" value="Login">
				</div>
			</form>
			</div>
			</div>';
  	}

  	function saveInfo($obj,$array)
	{
		$valid =true;
		foreach($array as $key=>$value)
		{
			if($value=='')
			{
					$valid=false;
					break;
			}
		}
			
		if($valid)
		{
			$result=$obj->insert($array);	
		}
		return $valid;	
		
	}
	
  }
	
?>

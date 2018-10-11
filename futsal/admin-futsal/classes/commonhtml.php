<?php

  class Commonhtml
  {
  	function getLeftSection()
  	{
  		echo '<div class="col-md-4">
					<ul class="nav nav-pills nav-stacked">
						<li role="presentation"><a href="bookings">Bookings</a></li>
						<li role="presentation"><a href="notice">Notice</a></li>
						<li role="presentation"><a href="users">Users</a></li>
						<li role="presentation"><a href="login&logout=true">Logout</a></li>
					</ul>
				</div>';
  	}

  	function getLoginForm()
  	{
  		echo '
			<div class="row"> 
			<div class="col-md-4 col-center"></div>
			<div class="col-md-4" style="border: 1px solid black; padding: 10px;"> 
			<h2 class="text-primary" style=" background: black; margin: 20px 2px 20px 2px; border-radius: 10px; text-align: center;">Futsal Vendor Log in</h2>
			<form action="index.php" method="post">
				<div class="form-group">
					<label for="email">Email:</label>
					<input type="email" class="form-control" id="email" name="email" required>
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
			<div class="col-md-4 col-center"></div>
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

<?php
	require '../includes/autoloader.php';

	//@creating the instance of common html
	$object=new CommonHtml();
	$object->getLeftSection();//@getting the left section 

    echo '<div class="col-md-8">';
	
	if (isset($_POST['submit'])) 
	{
        $_POST['date'] = date("Y/n/j", strtotime($_POST['date']));
        unset($_POST['submit']);
		$table='notices';
		$databaseTable = new DatabaseTable($pdo,$table);
		$databaseTable->insert($_POST);
		echo '<h2>Notice added!</h2>';
	}
	else {
		if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) 
		{
?>
            <div class="row">
            <div class="col-md-1 col-centered"></div>
            <div class="col-md-6">
                <h2>Add Notice</h2>
                <form action="" method="POST">
                    <input type="hidden" name="futsal_id" value="<?php echo $_SESSION['id']; ?>">
                    <div class="form-group">
                        <input type="date" class="form-control" name="date">                     
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="sel" class="control-label">Open:</label>
                        <select class="form-control" id="sel" name="is_open">
                            <option value="yes">yes</option>
                            <option value="no">no</option>
                        </select>                     
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="desc" name="description" placeholder="Notice Description"></textarea>
                    </div>
                    
                    <input type="submit" class="btn btn-primary" name="submit" value="Add Notice">
                </form>
            </div>
            <div class="col-md-3 col-centered"></div>
            </div>
			

		<?php
		}

		else 
		{
			//@getting login form if session is unset
			$object=new CommonHtml();
			$object->getLoginForm();
		}

	}



echo '</div>';
?>
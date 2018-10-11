<?php
		function saveInfo($obj,$array)
		{
			$valid =true;
			foreach($array as $key=>$value)
			{
				if($value==='')
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

				
?>
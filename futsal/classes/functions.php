<?php
	class Functions
	{
		//@Fetching the data to the home page 
		//@specially the are that are hot news of website
		public function fetchImage($array)
		{
			foreach ($array as $story) 
			{
				//@ it only fetch the data which is marked  as publish
				//@i.e publish value is 1
				if($story['publish']==1)
				{
						echo '<li>';
						if(isset($story['image']))
						{
							echo '<img alt="' . $story['title'] . '" src="../productimages/' . $story['image'] . '" />';
						}
						else 
						{
							if (is_file('../productimages/' . $story['id'] . '.jpg')) 
							{
									echo '<img alt="' . $story['title'] . '" src="../productimages/' . $story['id'] . '.jpg" />';

							}
							else
									echo '<div class="noimage"></div>';
						}
						echo '<div class="info"><h2>'. $story['title'] .'</h2>';
						echo '<p>' . nl2br($story['description']) . '</p>';
						echo'<h5>Date:'.$story['date'].'</h5>';
						echo'<h5>Added By:'.$story['addedBy'].'</h5>';
				}
				
			}
		}

		function saveInfo($obj,$array)
		{
			$valid =true;
			foreach($array as $key=>$value)
			{
				if($value=="")
				{
					$valid=false;
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
		
<?php
function autoload($name)
	{
		require '../classes/'.strtolower($name).'.php';
	}
	spl_autoload_register('autoload');

	$connection=new connection();
	$pdo=$connection->getConnection();
?>
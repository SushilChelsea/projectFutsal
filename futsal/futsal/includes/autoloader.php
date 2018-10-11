<?php
//@this is an autoloader function that require the php files
	function autoload($name) {
		require '../classes/'.strtolower($name).'.php';
	}
	spl_autoload_register('autoload');

	//@creating the instance of connection class
	// $connection = new connection();
	// $pdo = $connection->getConnection();
?>
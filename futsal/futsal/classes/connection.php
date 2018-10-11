<?php
	
  //@connectin class
  class Connection
  {
  	//@function to establish the connection with database
  	function getConnection()
  	{
  		$server='localhost';
		$user='root';
		$password='';
		$databaseName='dissertation';

		$pdo = new PDO('mysql:host='.$server.';dbname='.$databaseName,$user,$password);
		return $pdo;
  	}
	
  }
	
    
  

?>

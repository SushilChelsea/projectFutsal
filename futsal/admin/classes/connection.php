<?php

  class Connection
  {
  	function getConnection()
  	{
  		$server='localhost';
		$user='root';
		$password='';
		$databaseName='dissertation';

		$pdo=new PDO('mysql:host='.$server.';dbname='.$databaseName,$user,$password);
		return $pdo;
  	}
	
  }
	
?>

<?php
	require '../functions/functions.php';

	session_start();

	if(!isset($_GET['page'])) {
		$_GET['page']='home'; 
	}

	require '../pages/'.$_GET['page'].'.php';

	$variables=[
		'title'=>$title,
		'contents'=>$contents
	];
	echo bufferFiles('../templates/layout.php',$variables);
?>

	

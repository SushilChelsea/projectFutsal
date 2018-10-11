<?php

require '../functions/functions.php';
session_start();

//unset all the sessions variables when logout is clicked
if (isset($_GET['logout'])) {
	session_unset();
	unset($_SESSION['loggedin']);
	unset($_SESSION['username']);
}

//checking if the get variable is set or not

if (!isset($_SESSION['loggedin'])) {
	$_GET['page'] = 'login';
}


if ($_GET['page'] == '') {
	require '../pages/login.php';
} else {
	require '../pages/' . $_GET['page'] . '.php';
}
//creating arrays
$templateVars = [
	'title' => $title,
	'contents' => $contents
];

//buffering the files
echo bufferFiles('../templates/layout.php', $templateVars);
?>

	

<?php
	#this will generate the entire user stats
	session_start();
	include_once("../lib/userController.php");
	$session = $_SESSION['SESSION'];
	$action = $_POST['Action'];

	if($action=="get+all+users")
		{
			echo getAllUsers();
		}
	else if($action=="get+user+details")
		{
			$tkID = $_POST['tkID'];
			echo getUserDetails($tkID);
		}
	else
		{
			#page not found
		}
?>
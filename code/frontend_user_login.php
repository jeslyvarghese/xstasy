<?php
	session_start();

	include_once("../libraries/sessionController.php");
	include_once("../cult/deadlockConfig.php");
	#this page to encapsulate modules for techkshetra login via javascripts

	if(!isset($_SESSION['tkID']))
		{
			$jsonStatus['Status'] = "Logged Out";
		}
	if($_GET['action']=="login")
		{	if(!isset($_SESSION['tkID']))
				{	
					$jsonStatus['Status'] = "Login";
				}
			else 
				{
					$tkID = $_SESSION['tkID'];
					if(!userExists($_SESSION['tkID']))
						{
							
							insertUser($tkID,$GLOBALS['initQID']);
							$jsonStatus['Status'] = "Welcome";
						}
					else
						{
							
							$jsonStatus['Status'] = "Welcome Back";
						}
					updateSessionID($tkID);
					$_SESSION['SESSIONID'] = getSessionID($tkID);
					$_SESSION['QID'] = getCurrentQuestion($tkID);
				}
				
		}
	else
		{
			$jsonStatus['Status'] = "NULL";
		}
	echo json_encode($jsonStatus);
?>
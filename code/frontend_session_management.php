<?php
	session_start();
	include_once("../libraries/sessionController.php");

	
	$action =$_GET['action'];
	

	if($action=="log out")
		{
			resetSession($tkID);
			unset($_SESSION['SESSIONID']);
			unset($_SESSION['tkID']);
			$jsonData['Status'] = "Logged Out";
		}
	else if($action=="validate session")
		{
			if(!isset($_SESSION['tkID']))
			{
				$jsonData['Status'] = "Logged Out";
			}
			else if(isset($_SESSION['tkID'])&&!isset($_SESSION['SESSIONID']))
				{
				$jsonData['Status'] = "Log In";
				}
			else
			{
				$tkID = $_SESSION['tkID'];
				$session = $_SESSION['SESSIONID'];
				if($session==getSessionID($tkID))
					{
						$jsonData['Status'] = "Logged In";
					}		
				else
					{
						$jsonData['Status'] = "Logged Out";
					}
			}
		}
	echo json_encode($jsonData);

?>
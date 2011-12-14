<?php
#this part controls the navigations of the users
#returns json
session_start();

include_once("../libraries/sessionController.php");
include_once("../libraries/userStructureNavigation.php");


$tkID = $_SESSION['tkID'];
$sessionid = $_SESSION['SESSIONID'];
$action = $_GET['NavigationAction'];
if(!(isset($tkID)||isset($sessionid)))
	{
		#redirect to login
	}

if(($sessionid!=getSessionID($tkID)))
	{
		#redirect to login
	}
$qID = $_SESSION['QID'];
if($action=="display navigator")
	{
		
		
		$jsonData = getNavigations($tkID,$qID);
		echo json_encode($jsonData);
 	}
 else if($action=="navigate to")
 	{
 		$direction = $_GET["direction"];
 		if($direction=="TopLeft")
 			{
 				$new_qID = navigationTopLeft($qID);
 			}
 		else if($direction=="TopRight")
 			{
 				$new_qID = navigationTopRight($qID);
 			}
 		else if($direction=="BottomRight")
 			{					
 				$new_qID = navigationBottomRight($qID);
 			}
 				
 		else if($direction=="BottomLeft")
 			{
				$new_qID = navigationBottomLeft($qID);
 			}
 		if(navigateToQuestion($tkID,$new_qID))
 			{
 				updateQuestion($tkID,$new_qID);
 				$jsonData['Status'] = "NAVIGATION_SUCCESS";
 			}
 		else
 			{
 				$jsonData['Status'] = "NAVIGATION_FAIL";
 			}
 		echo json_encode($jsonData);
 			
 	}

	?>
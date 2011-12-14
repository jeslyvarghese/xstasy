<?php
#This file renders question to the users
session_start();

include_once("../libraries/sessionController.php");
include_once("../libraries/userPermissions.php");


$tkID = $_SESSION['tkID'];
$sessionid = $_SESSION['SESSIONID'];
if(!(isset($tkid)||isset($sessionid)))
	{
		
		#redirect to login page
	}

if(($sessionid!=getSessionID($tkID)))
	{
		#redirect to login page
	}
$qID = getCurrentQuestion($tkID);
if(isUserAllowed($qID,$tkID))
{
	echo questionRender($qID);
}
else
	{
		#redirect to 404 
	}
?>
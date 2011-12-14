<?php
#this file deals with the front end for answer validation
	session_start();
	
	include_once("../libraries/sessionController.php");
	include_once("../libraries/userPermissions.php");
	include_once("../libraries/answerValidation.php");
	
	$tkID = $_SESSION['tkID'];
	$sessionid = $_SESSION['SESSIONID'];
	if(!(isset($tkid)||isset($sessionid)))
		{
			#redirect to login
		}

	if(($sessionid!=getSessionID($tkID)))
		{
			#redirect to login
		}
	$qID = getCurrentQuestion($tkID);
	$answer = sanitizeText($_GET['Answer']);
	$answer = standardizeAnswer($answer);
	updateEntry($tkID,$qID);
	if(checkAnswer($qID,$answer))
		{	if(!isCracked($qID))
				{
					questionCrack($qID);
				}
			userLevelUp($qID,$tkID);
			$jsonData['Status']= "LEVEL UP"
		}
	else
		{
			$jsonData['Status']= "TRY AGAIN";
		}
	echo json_encode($jsonData);
?>
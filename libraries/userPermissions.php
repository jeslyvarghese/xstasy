<?php
	#this file deals with users permission to acess different questions as well as granting permission upon correct answer
	include_once('questionController.php');
	include_once('userController.php');
	include_once('structureNavigator.php');
	function isUserAllowed($qID,$tkID)
		{
			$questionIDArray = getQID($tkID);
			foreach($questionIDArray as $questionID)
				{
					if($qID==$questionID)
						return true;
						
				}
			return false;
		}
	function userLevelUp($qID,$tkID)
		{
			if(isUserCracked($tkID,$qID)==0)
				{
					Crack($tkID,$qID);
					$left = navigationBottomLeft($qID);
					$right = navigationBottomRight($qID);
					insertEntry($tkID,$left);
					insertEntry($tkID,$right);
				}
		}
	?>

<?php
	#this file gives the navigation pane
	include_once('structureNavigator.php');
	include_once('userPermissions.php');
	function getNavigations($tkID,$qID)
		{	
			$NavigationPane['TopLeft'] = navigationTopLeft($qID);
			$NavigationPane['TopRight'] = navigationTopRight($qID);
			$NavigationPane['BottomLeft'] = "NULL";
			$NavigationPane['BottomRight'] = "NULL";
			if(isUserAllowed($qID,$tkID)==1)
				{
					$NavigationPane['BottomLeft'] = navigationBottomLeft($qID);
					$NavigationPane['BottomRight'] = navigationBottomRight($qID);
				}
			return $NavigationPane;
		}
	function  navigateToQuestion($tkID,$qID)
		{
			if(isUserAllowed($qID,$tkID)==1)
				{
					updateQuestion($tkID,$qID);
					return 1;
				}
			else
				{
					return 0;
				}
		}
?>

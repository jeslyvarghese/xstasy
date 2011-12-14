<?php
	session_start();
	$session = $_SESSION['SESSION'];
	$action = $_GET['Action']; 	
	
	include_once("../lib/structureNavigator.php");
	include_once("../cult/deadlockconfig.php");
	if(!isset($session))
		echo "Page Not Foind!";
		
	if($action=="traverse tree") #this section is pending
		{
			$max_level = getMaxLevel();
		
			for($i=1;$i<=$max_level;$i++)
				{
					$level[$i]= getQID($i);
				}
			for($i=1;$i<=$max_level;$i++)
				{	
					
					foreach($level[$i] as $qID)
						{
							$jsonData[$qID]['Level'] = $i;
							$jsonData[$qID]['TopLeft']= navigationTopLeft($qID);
							$jsonData[$qID]['TopRight']= navigationTopRight($qID);
							$jsonData[$qID]['BottomLeft']= navigationBottomLeft($qID);
							$jsonData[$qID]['BottomRight']= navigationBottomRight($qID);
						}
				}
			echo json_encode($jsonData);
		}
	else if($action=="insert question")
		{
			$qID = $_POST['qID'];
			$topLeft = $_POST['TopLeft'];
			$topRight = $_POST['TopRight'];
			$level = $_POST['level'];#Write a function to calculate level
			insertqID($qID,$topLeft,$topRight,$level);
		}
	else if($action=="modify bottom")
		{
			$qID = $_POST['qID'];
			$bottomLeft = $_POST['BottomLeft'];
			$bottomRight = $_POST['BottomRight'];
			modifyBottom($qID,$bottomLeft,$bottomRight);
		}
	else if($action=="modify top")
		{
			$qID = $_POST['qID'];
			$topLeft = $_POST['TopLeft'];
			$topRight = $_POST['TopRight'];
			modifyTop($qID,$topLeft,$topRight);
		}

	
	?>
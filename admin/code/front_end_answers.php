<?php
	#This controls front end interactions for adding answers
	session_start();
	$session = $_SESSION['SESSION'];
	$action = $_POST['Action']; 
	include_once("../lib/answerController.php");
	if(!isset($session))
		#Page not found
	if($action=="insert+answer")
		{
			$answer = $_POST['Answer'];
			$qID = $_POST['qID'];
			$answer = standardizeAnswer($answer);
			$answer = cryptAnswer($qID,$answer);
			insertAnswer($qID,$answer); 
			echo "Answer".$answer."<br/>".$qID;
		}
	else if($action=="check+answer")
		{
			$answer = $_POST['Answer'];
			$qID = $_POST['qID'];
			$answer = standardizeAnswer($answer);
			$answer = cryptAnswer($qID,$answer);
			if(checkAnswer($qID,$answer))
				{
					echo "RIGHT";
				}
			else
				{
					echo "WRONG";
				}
		}
	?>
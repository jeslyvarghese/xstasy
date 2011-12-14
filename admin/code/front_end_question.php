<?php
	#This controls front end interactions for the administrator with the questions database
	session_start();
	include_once("../lib/questionController.php");
	$session =$_SESSION['SESSION'];
	if(!isset($session))
		echo  "Page not found";
		#404 Page not found!!


	$action = $_GET['Action'];
	echo $action;

	if($action == "insert question")
		{	$question = $_POST['Question'];
			addQuestion($question);
			echo "Question".$question;
		}
	else if($action=="render question")
		{
			$qID = $_POST['QID'];
			echo questionRender($qID);
		}
	else if($action=="list cracked")
		{
			echo json_encode(getCrackedList());
		}
	else if($action=="list questions")
		{
			echo json_encode(getQuestionList());
		}
	else
		{
			echo "Page not found!!";
			#page not found
		}

	?>
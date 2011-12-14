<?php
	session_start();
	$_SESSION['SESSION'] = 0000;
	include_once("/code/front_end_question.php");
	questionRender(4);
	?>
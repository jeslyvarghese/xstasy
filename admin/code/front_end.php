<?php
	session_start();
	$dbpwd = $_POST['Password'];
	$username = $_POST['UserName'];
	if(crypt(crypt($dbpwd,"d3@dL0cK!"),"3v0LutioN")==crypt(crypt("123#C.L.U&FLYNN#321","d3@dL0cK!"),"3v0LutioN"))
		{
			$_SESSION['SESSION']=0000;
			#a function to mail deadlock@techkshetra.com abou the login
			$to = "deadlock@techkshetra.com";
			$subject = "Administrator Login To Deadlocl";
			$message = "There has been a login to Deadlock at time".time()."Using username:".$username;
			$header = "From:deadlock@techkshetra.com";
			mail($to,$subject,$message,$header);
			echo("Successfully Logged In!");
		}
	else
		{
			die("Invalid Login");
		}
	?>
<?php
	#this library manipulates questions table
	include_once('connectTo.php');
	include_once('../cult/mania.php');
	
	function questionRender($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT innerHTML FROM questions WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['innerHTML'];
		}
	
	function isCracked($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT Cracked FROM questions WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $resultset['Cracked'];
		}
	
	function questionCrack($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE questions SET Cracked = 1 WHERE qid = '$qID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	function addQuestion($innerHTML)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "INSERT INTO questions(innerHTML,Cracked) VALUES('$innerHTML',0)";
			endConnection($cxn);
		}
		
		?>

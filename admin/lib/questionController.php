<?php
	#this library manipulates questions table
	include_once('connectTo.php');
	include_once('../cult/mania.php');
	
	function questionRender($qID)
		{
			$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT innerHTML FROM questions WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['innerHTML'];
		}
	
	function isCracked($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT Cracked FROM questions WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['Cracked'];
		}
	
	function questionCrack($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE questions SET Cracked = 1 WHERE qid = '$qID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	function addQuestion($innerHTML)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "INSERT INTO questions(innerHTML,Cracked) VALUES('$innerHTML',0)";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	function getCrackedList()
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT * FROM questions WHERE Cracked = 1";
			$resultset = mysqli_query($cxn,$sql) or die(mysqli_error($cxn));
			
			while($questionArray = mysqli_fetch_assoc($resultset))
				{
					$returnArray[]=$questionArray['qid'];
				}
			endConnection($cxn);
			return $returnArray;
		}
	function getQuestionList()
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT * FROM questions";
			$resultset = mysqli_query($cxn,$sql);
			while($questionArray = mysqli_fetch_assoc($resultset))
				{
					$returnArray[$questionArray['qid']]=$questionArray['innerHTML'];
				}
			endConnection($cxn);
			return $returnArray;
		}
		
		?>

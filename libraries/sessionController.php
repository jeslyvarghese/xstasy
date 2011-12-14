<?php
	#this file deals with users-session management
	include_once('connectTo.php');
	include_once('../cult/mania.php');
	include_once('userController.php');
	function userExists($tkID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT * FROM userlog WHERE tkID = '$tkID'";
			$resultset = mysqli_query($cxn,$sql);
			endConnection($cxn);
			if(mysqli_num_rows($resultset)>0)
				return 1;
			else
				return 0;
		}
	function insertUser($tkID,$qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "INSERT INTO userlog(tkID,CurrentQID) VALUES('$tkID','$qID')";
			mysqli_query($cxn,$sql);
			$sessionID = rand(999,9999);
			$sql = "UPDATE userlog SET sessionID = '$sessionID' WHERE tkID = '$tkID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
			insertEntry($tkID,$qID);
			updateSessionID($tkID);
		}
	function updateQuestion($tkID,$qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE userlog SET currentQID = '$qID' WHERE tkID = '$tkID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	function getTimeStamp($tkID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT timeStamp FROM userlog WHERE tkID = '$tkID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['timeStamp'];
		}
	
	function getSessionID($tkID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT sessionID FROM userlog WHERE tkID = '$tkID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['sessionID'];
		}

	function updateSessionID($tkID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$timeStamp = getTimeStamp($tkID);
			$sessionID = crypt($timeStamp&$tkID,rand(999,9999));
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE userlog SET sessionID = '$sessionID' WHERE tkID = '$tkID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	function getCurrentQuestion($tkID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT currentQID FROM userlog WHERE tkID = '$tkID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['currentQID'];
		}
	function resetSession($tkID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE userlog SET sessionID = '0' WHERE tkID = '$tkID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}

	
	?>

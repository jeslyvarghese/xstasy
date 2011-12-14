<?php 
	#this deals with the users table
	include_once('connectTo.php');
	include_once('../cult/mania.php');
	function insertEntry($tkID,$qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "INSERT INTO users(tkID,qID,Attempts) VALUES('$tkID','$qID',0)";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	function updateEntry($tkID,$qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT Attempts FROM users WHERE tkID='$tkID' AND qID = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$attempt = mysqli_fetch_assoc($resultset);
			$attempt = $attempt['Attempts']+1;
			$sql = "UPDATE users SET Attempts = '$attempt' WHERE tkID='$tkID AND qID='$qID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	function getQID($tkID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT qID FROM users WHERE tkID='$tkID'";
			$resultset = mysqli_query($cxn,$sql);
			while($qID = mysqli_fetch_assoc($resultset))
				{
					$qset[] = $qID['qID'];
				}
			endConnection($cxn);
			return $qset;
		}
	function getAttempts($tkID,$qID)
		{
			$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT Attempts FROM users WHERE tkID='$tkID' AND qID = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$resultarray = mysqli_fetch_assoc($resultset);
			return $resultarray['Attempts'];			
		}
	function isUserCracked($tkID,$qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT Cracked FROM users WHERE tkID='$tkID' AND qID = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $resultset['Cracked'];
		}
	function Crack($tkID,$qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE users SET Cracked=1 WHERE tkID='$tkID' AND qID='$qID'";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	
	function leaderBoard()
		{
			$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);		
			selectDatabase($cxn,$dbname);
			$sql = "SELECT tkID SUM(Cracked) FROM userbase WHERE Cracked =1 GROUP BY tkID";
			$resultset = mysqli_query($cxn,$sql);
			while($resultarray = mysqli_fetch_assoc($resultset))
				{
					$jsonData[]['tkID'] = $resultarray['tkID'];
					$jsonData[]['Number'] = $resultarray['SUM(Cracked)'];
				}
			return json_encode($jsonData);
		}

	?>

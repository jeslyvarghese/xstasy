<?php
	#this file deals with structure table
	include_once('connectTo.php');
	include_once('../cult/mania.php');
	
	function navigationTopLeft($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT prevLeftQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['prevLeftQID'];
		}
	
	function navigationTopRight($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT prevRightQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['prevRightQID'];
		}
	
	function navigationBottomRight($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT nextRightQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['nextRightQID'];
		}
	
	function navigationBottomLeft($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT nextLeftQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['nextLeftQID'];
		}
	
	function getLevel($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT level FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['level'];
		}
	
	function checkqIDExist($qID)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT * FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			if(mysqli_num_rows($resultset)!=0)
				return 1;
			else
				return 0;
		}
	
	function insertqID($qID,$topLeft,$topRight)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "INSERT INTO structure(qID,nextLeftQID,nextRightQID,prevLeftQID,prevRightQID) VALUES('$qid',0,0,'$topLeft','$topRight')";
			mysqli_query($cxn,$sql);	
			endConnection($cxn);
		}
	
	function modifyBottom($qID,$bottomLeft,$bottomRight)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE structure SET nextLeftQID='$bottomLeft',nextRightQID='$bottomRight' WHERE qID='$qID'";
			mysqli_query($cxn,$sql);	
			endConnection($cxn);
		}
	
	function modifyTop($qID,$bottomLeft,$bottomRight)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE structure SET prevLeftQID='$bottomLeft',prevRightQID='$bottomRight' WHERE qID='$qID'";
			mysqli_query($cxn,$sql);	
			endConnection($cxn);
		}
	
		
?>

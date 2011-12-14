<?php
	#this file deals with structure table
	include_once('connectTo.php');
	include_once('../cult/mania.php');
	
	function navigationTopLeft($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT prevLeftQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql) or die(mysqli_error($cxn));
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['prevLeftQID'];
		}
	
	function navigationTopRight($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT prevRightQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['prevRightQID'];
		}
	
	function navigationBottomRight($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT nextRightQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['nextRightQID'];
		}
	
	function navigationBottomLeft($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT nextLeftQID FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['nextLeftQID'];
		}
	
	function getLevel($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT level FROM structure WHERE qid = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['level'];
		}
	
	function checkqIDExist($qID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
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
	
	function insertqID($qID,$topLeft,$topRight,$level)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "INSERT INTO structure(qID,nextLeftQID,nextRightQID,prevLeftQID,prevRightQID,level) VALUES('$qID',0,0,'$topLeft','$topRight',$level)";
			mysqli_query($cxn,$sql);	
			endConnection($cxn);
		}
	
	function modifyBottom($qID,$bottomLeft,$bottomRight)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE structure SET nextLeftQID='$bottomLeft',nextRightQID='$bottomRight' WHERE qID='$qID'";
			mysqli_query($cxn,$sql);	
			endConnection($cxn);
		}
	
	function modifyTop($qID,$topLeft,$topRight)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "UPDATE structure SET prevLeftQID='$topLeft',prevRightQID='$topRight' WHERE qID='$qID'";
			mysqli_query($cxn,$sql);	
			endConnection($cxn);
		}
	function getQID($level)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT qID FROM structure WHERE level = '$level'";
			$resultset = mysqli_query($cxn,$sql);
			$returnArray = array();
			while($questionArray = mysqli_fetch_assoc($resultset))
				{
					$returnArray[] = $questionArray['qID'];
				}
			endConnection($cxn);
			return $returnArray;
		}	
	function getMaxLevel()
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT MAX(level) FROM structure";
			$resultset = mysqli_query($cxn,$sql);
			$questionArray = mysqli_fetch_assoc($resultset);
			endConnection($cxn);
			return $questionArray['MAX(level)'];
		}	
?>

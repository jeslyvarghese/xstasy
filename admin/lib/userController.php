<?php
	include_once("connectTo.php");

	function getAllUsers()
		{	#username part pending in here
			$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect($dbhost,$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT tkID,sessionID,currentQID FROM userlog";
			$resultset = mysqli_query($cxn,$sql);
			while($resultArray=mysqli_fetch_assoc($resultset))
				{
					$jsonData[$resultArray['tkID']]['CurrentQID'] = $resultArray['currentQID'];
					if($resultArray['currentQID']!=0)
						{
							$jsonData[$resultArray['tkID']]['Online'] = true;
						}
					else
						{
							$jsonData[$resultArray['tkID']]['Online'] = false;
						}
					$jsonData[$resultArray['tkID']]['LastLogin'];
				} 
			endConnection($cxn);
			return json_encode($jsonData);
		}

	function getUserDetails($tkID)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect($dbhost,$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT qID,Attempts,Cracked FROM users";
			$resultset = mysqli_query($cxn,$sql);
			while($resultArray = mysqli_fetch_array($resultset))
				{
					$jsonData[$resultArray['qID']]['Attempts'] = $resultArray['Attempts'];
					$jsonData[$resultArray['qID']]['Cracked'] =$resultArray['Cracked'];
				}
			endConnection($cxn);
			return json_encode($jsonData);
		}
?>
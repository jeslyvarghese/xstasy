<?php
	#this library contains elements necessary for answer validation
	include_once('connectTo.php');
	include_once('../cult/mania.php');
	
	function standardizeAnswer($answer)
		{	$answer = strtolower($answer);

			$standardAnswer = preg_replace("[^a-z0-9]","",$answer);
			#do preg replaces for whitespaces, convert to lowercases
			return $standardAnswer;
		}
	
	function cryptAnswer($qID,$answer)
		{
			return crypt(crypt($answer,$qID),$qID);
		}
	function checkAnswer($qID,$answer)
		{	$uname = $GLOBALS['dbuname'];
			$password = $GLOBALS['dbpwd'];
			$hostname = $GLOBALS['hostname'];$dbname=$GLOBALS['dbname'];
			$cxn = connect($hostname,$uname,$password);
			selectDatabase($cxn,$dbname);
			$sql = "SELECT Answer FROM answers WHERE qID = '$qID'";
			$resultset = mysqli_query($cxn,$sql);
			endConnection($cxn);
			$flag = 0;
			while($resultarray = mysqli_fetch_assoc($resultset))
				{
					if($resultarray['Answer']==$answer)
						{
							$flag =1;
							break;
						}
					}
			
			if($flag==1)
				return 1;
			else
				return 0;
		
		}
	?>

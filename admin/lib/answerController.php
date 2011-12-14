<?php
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
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
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
	function insertAnswer($qID,$answer)
		{	$dbname = $GLOBALS['dbname'];
			$dbuname = $GLOBALS['dbuname'];
			$dbpwd = $GLOBALS['dbpwd'];
			$cxn = connect("localhost",$dbuname,$dbpwd);
			selectDatabase($cxn,$dbname);
			$sql = "INSERT INTO answers(qID,answer) VALUES('$qID','$answer')";
			mysqli_query($cxn,$sql);
			endConnection($cxn);
		}
	?>
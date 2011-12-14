<?php
	#This library establishes a connection to the database and returns the handler
	
	function connect($hostname,$username,$dbpwd)
		{
			$connection = mysqli_connect($hostname,$username,$dbpwd);
			return $connection;
		}
	function selectDatabase($cxn,$dbname)
		{
			mysqli_select_db($cxn,$dbname);
		}
	function endConnection($cxn)
		{
			mysqli_close($cxn);
		}
		?>


<?php

/*
handles log creation

@author  Alex Markenzon
@since   October
@version 2
*/

	function writeLogs($log){
		date_default_timezone_get();
		$date = date('Y-m-d H:i:s');
		$file = "logs.txt";
		$fh = fopen($file, 'a') or die("Can't open file");
		if(strlen($log) > 100)
			fwrite($fh, "\n" . $date . "\t" . "String is too long to print because it has " . strlen($log) . " characters");
		else	
			fwrite($fh, "\n" . $date . "\t" . $log);
		fclose($fh);
		
	}
	
	function writeLogsDB($log){
		date_default_timezone_get();
		$date = date('Y-m-d H:i:s');
		$file = "DBlogs.txt";
		$fh = fopen($file, 'a') or die("Can't open file");
		if(strlen($log) > 100)
			fwrite($fh, "\n" . $date . "\t" . "String is too long to print because it has " . strlen($log) . " characters");
		else	
			fwrite($fh, "\n" . $date . "\t" . $log);
		fclose($fh);
		
	}

	function writeLogsDMZ($log){
		date_default_timezone_get();
		$date = date('Y-m-d H:i:s');
		$file = "DMZlogs.txt";
		$fh = fopen($file, 'a') or die("Can't open file");
		if(strlen($log) > 100)
			fwrite($fh, "\n" . $date . "\t" . "String is too long to print because it has " . strlen($log) . " characters");
		else	
			fwrite($fh, "\n" . $date . "\t" . $log);
		fclose($fh);
		
	}
?>

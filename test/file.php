<?php
require_once('../includes/functions.php');
	$file = 'file_test.txt';
	$handle = fopen($file, "w");
	$content = "123\n456";
	fwrite($handle, $content);
	$pos = ftell($handle);

	fseek($handle,$pos-6);
	fwrite($handle, "he");

	rewind($handle);
	fwrite($handle, "k");

	fclose($handle);

	log_action("dsds","sdds");
?>
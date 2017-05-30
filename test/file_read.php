<?php
	$file = 'file_test.txt';
	$handle = fopen($file, "r");
	
	$content = fread($handle,filesize($file));
	echo nl2br($content);

	fclose($handle);
	echo "<hr>";

	$file = 'file_test.txt';
	$handle = fopen($file, "r");

	while (!feof($handle)) {
		$content = fgets($handle);
		echo $content;
	}
?>
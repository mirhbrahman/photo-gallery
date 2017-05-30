<?php
	echo "<pre>";
	print_r($_FILES['file_upload']);
?>


<html>
	<head>
		<title>Upload</title>
	</head>
	<body>
	<?php if(!empty($message)) { echo "<p>{$message}</p>"; } ?>
		<form action="upload.php" enctype="multipart/form-data" method="POST">

		 <input type="hidden" name="MAX_FILE_SIZE" value="1000000" />
		 <input type="file" name="file_upload" />

		 <input type="submit" name="submit" value="Upload" />
		</form>
	
	</body>
</html>
<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
	$log_file = $_SERVER["DOCUMENT_ROOT"]."/php17/logs/log.txt";
		if(isset($_GET['clear'])){
			if($_GET['clear'] == "true"){
			file_put_contents($log_file, "Log deleted by user id: {$session->user_id}"."\r\n");
			redirect_to("logfile.php");
		}
	}	
?>

<?php include_layouts_template("admin_header.php");?>
   <div class="contaner">
	   <div class="raw">
		   <div class="col-md-5">
		   <a style="color: green;" href="index.php">&laquo; Back</a>
				<h3 style="margin-top: 0px;">Log File</h3>
				<a style="color: red;" href="logfile.php?clear=true" onClick="return confirm('Are you sure to clear log file?')">Clear log file</a>
					
				<?php
				
					if(file_exists($log_file) && is_readable($log_file)&&$handle = fopen($log_file, "r")){
						echo "<ol>";
						while (!feof($handle)) {
							$content = fgets($handle);
							if(trim($content) != ""){
								echo "<li>{$content}</li>";
							}	
						}
						echo "</ol>";
						fclose($handle);
					}else{
						echo "Log file not found.";
					}
				?>
			</div>
		</div>
	</div>
	
<?php include_layouts_template("admin_footer.php");?>

<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}

?>

<?php
	$max_file_size = 1048576;   // expressed in bytes
	                            //     10240 =  10 KB
	                            //    102400 = 100 KB
	                            //   1048576 =   1 MB
	                            //  10485760 =  10 MB

	if(isset($_POST['submit'])){
		$photo = new Photograph();
		$photo->caption = $_POST['caption'];
		$photo->attach_file($_FILES['file_upload']);

		if($photo->save()){
			$session->message("Upload successfull.");
			header("Location:index.php","refresh");
		}else{
			$message = join("<br>",$photo->errors);
			$session->message($message);
		}
	}else{
		$session->message("");
	}
?>


<?php include_layouts_template("admin_header.php");?>
   <div class="contaner">

   		<div class="raw">
   			<?php echo $session->message(); ?>		
		    
		    <div class="col-md-5">
		    <a style="color: green;" href="index.php">&laquo; Back</a>
			  <h3 style="margin-top: 0px;">Photo Upload</h3>

			  <form action="photo_upload.php" enctype="multipart/form-data" method="POST">
			 	* Max size 1MB
			    <input  type="hidden" name="MAX_FILE_SIZE" value="<?php echo $max_file_size; ?>" />
			    <input class="form-control" type="file" name="file_upload" />
			    <label style="margin-top: 5px;">Caption <span style="font-weight: normal;">(Max length 255 characters)</span></label>
			    <input class="form-control" type="text" name="caption" value="" />
			    <br>
			    <input class="btn btn-primary" type="submit" name="submit" value="Upload" />
			  </form>

 			</div>
		</div>
	</div> 
<?php include_layouts_template("admin_footer.php");?>
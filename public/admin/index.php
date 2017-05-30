<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
$user =  User::find_by_id($session->user_id);
?>

<?php include_layouts_template("admin_header.php");?>
   <div class="contaner">

   		<div class="raw">
   			
		    
		    <div class="col-md-5">
		    <p style="margin: 0;color: #E84C3D;">Welcome, <?php echo htmlentities($user->username);?></p>
			    <h3 style="margin-top: 5px;">Menu</h3>
			    <h3 style="color: blue;margin:0;"><?php echo $session->message(); ?></h3>
				<ul class="list-group">
					  <li class="list-group-item"><a href="create_user.php">Create New User</a></li>
					  <li class="list-group-item"><a href="list_user.php">User List</a></li>
					  <li class="list-group-item"><a href="logfile.php">Log file</a></li>
					  <li class="list-group-item"><a href="photo_upload.php">Upload Photo</a></li>
					  <li class="list-group-item"><a href="list_photos.php">Photo List</a></li>
				</ul>
			</div>
		</div>
	</div>	
<?php include_layouts_template("admin_footer.php");?>
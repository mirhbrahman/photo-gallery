<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
	$users = User::find_all();
?>

<?php include_layouts_template("admin_header.php");?>
   <div class="contaner">
	   <div class="raw">
		   <div class="col-md-5">
		   <a style="color: green;" href="index.php">&laquo; Back</a>
				<h3 style="margin-top: 0px;">User List</h3>
				<a style="margin-bottom: 5px;" class="btn btn-info btn-sm" href="create_user.php">Create user</a>
				<ol>
				<?php foreach($users as $user):?>
					<li><?php echo htmlentities($user->username);?></li>
				<?php endforeach;?>
				</ol>
			</div>
		</div>
	</div>
	
<?php include_layouts_template("admin_footer.php");?>

<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
?>


<?php

	if(isset($_POST['submit'])){
		$email = trim($_POST['email']);
		$pass = trim($_POST['pass']);
		$con_pass = trim($_POST['con_pass']);


		//.........validatin
		if(!User::valid_email($email) || strlen($email) > 40){
			$session->message("Email is out of size or not valid!");
			redirect_to("create_user.php");
		}elseif(User::unique_email($email)){
			$session->message("Email already exist.");
			redirect_to("create_user.php");
		}elseif(strlen($pass) > 50) {
			$session->message("Password is out of size!");
			redirect_to("create_user.php");
		}elseif ($pass !== $con_pass) {
			$session->message("Password doesn't match with confirm Password!");
			redirect_to("create_user.php");
		}else{
			$user = new User();
			$user->username = $email;
			$user->password = User::password_hash($pass);
			if($user->save()){
				$session->message("User create successful.");
				redirect_to("index.php");
			}else{
				$session->message("User create fail.");
				redirect_to("index.php");
			}
		}
	}
?>


<?php include_layouts_template("admin_header.php");?>
   <div class="contaner">
	    <form action="create_user.php"  method="POST">
	   		<div class="raw">
	   			
			    <div class="col-md-5">
			    <a style="color: green;" href="index.php">&laquo; Back</a>
				  <h3 style="margin: 0px;">Create New User</h3>
				  <p style="color: red;margin: 0"><?php echo $session->message(); ?></p>		
			   
			       <label style="margin-top: 5px;">Email <span style="font-weight: normal;">(Max length 40 characters)</span></label>
				    <input class="form-control" type="text" name="email" value="" />
				    <br>
				    <label style="margin-top: 5px;">Password <span style="font-weight: normal;">(Max length 50 characters)</span></label>
				    <input class="form-control" type="Password" name="pass" value="" />
				    <br>
				    <label style="margin-top: 5px;">Confirm Password</label>
				    <input class="form-control" type="Password" name="con_pass" value="" />
				    <br>
				    <input class="btn btn-primary" type="submit" name="submit" value="Create" />

	 			</div>
			</div>
			</form>
	</div> 
<?php include_layouts_template("admin_footer.php");?>
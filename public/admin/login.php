<?php
require_once('../../includes/initializer.php');

if($session->is_logged_in()){redirect_to("index.php");}

if(isset($_POST['login'])){
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	$found_user = User::athunticate($username,$password);
	if($found_user){
		$session->login($found_user);
		log_action("Login","{$found_user->username} logged in.");
		redirect_to("index.php");
	}else{
		$message = "Username/Password combination incorrect";
	}
}else{
	$message = "";
	$username = "";
	$password = "";
}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Gallery</title>
	<link type="text/css" rel="stylesheet" href="../stylesheets/bootstrap.min.css"></link>
<link type="text/css" rel="stylesheet" href="../stylesheets/main.css"></link>

</head>
<body>
	  <div class="wrapper">
	    <form class="form-signin" action="login.php" method="post">       
	      <h2 class="form-signin-heading">Please login</h2>
	      <?php echo output_message($message);?>
	      <input type="text" class="form-control" name="username" placeholder="Email Address" required="" autofocus="" value="<?php echo htmlentities($username)?>" />
	      <input type="password" class="form-control" name="password" placeholder="Password" required="" value="<?php echo htmlentities($password)?>" />      
	       <button class="btn btn-md btn-primary btn-block" name="login" type="submit">Login</button>   
	    </form>
	  </div>

</body>
</html>
<?php
require_once('../../includes/initializer.php');

if($session->is_logged_in()){
	$session->logout();
	redirect_to("login.php");
}else{
	redirect_to("index.php");
}

?>
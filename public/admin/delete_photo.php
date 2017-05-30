<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php

	$id = isset($_GET['id'])?$_GET['id']:0;
	$photo = Photograph::find_by_id($id);

	if($photo->destroy()){
		$session->message("Delete successfull.");
		redirect_to("list_photos.php");
	}else{
		$session->message("Delete fail.");
		redirect_to("list_photos.php");
	}

?>

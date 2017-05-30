<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php

	$id = isset($_GET['id'])?$_GET['id']:0;
	$comment = Comment::find_by_id($id);

	if($comment->delete()){
		$session->message("Delete successfull.");
		redirect_to("photo_comment.php?id={$comment->photograph_id}");
	}else{
		$session->message("Delete fail.");
		redirect_to("photo_comment.php?id={$comment->photograph_id}");
	}
?>

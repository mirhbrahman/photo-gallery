<?php
require_once('../includes/session.php');
require_once('../includes/database.php');
require_once('../includes/database_object.php');
require_once('../includes/functions.php');
require_once('../includes/user.php');
require_once('../includes/photograph.php');
require_once('../includes/comment.php');

$id = isset($_GET['id'])?$_GET['id']:0;
$photo = Photograph::find_by_id($id);

if(!$photo){
	redirect_to("index.php");
}

if(isset($_POST['submit'])){
	$author = $_POST['author'];
	$body = $_POST['body'];
	$comment = Comment::make($photo->id,$author,$body);

	if($comment &&$comment->save()){
		redirect_to("full_photo.php?id={$comment->photograph_id}");
	}else{
		redirect_to("full_photo.php?id={$comment->photograph_id}");
		
	}
}

$comments = $photo->comments();


?>

<?php include_layouts_template_n("header.php");?>

    <div class="contaner" style="">
  	 <div class="col-md-6">
    	<img class="responsive" style="width: 600;" src="<?php echo "images/".$photo->filename;?>" alt="...">
    </div>
    	<div class="col-md-6">
    		<h4 style="margin-top: 0">New Comment</h4>
	    	<form action="full_photo.php?id=<?php echo $photo->id;?>" method="post">
	    		<label>Author</label>
	    		<input class="form-control" type="text" name="author">
	    		<label>Write your comment</label>
	    		<textarea style="resize: vertical;" class="form-control" name="body"></textarea>
	    		<br>
	    		<input class="btn-md btn-info" type="submit" name="submit" value="Add Comment">
	    	</form>
			<hr>
	    	<div>
	    	<?php if($comments):?>
	    	<?php foreach($comments as $comment):?>
		    	<div style="margin-bottom: 20px;">
		    		<p style="line-height: 5px;font-weight: bold;"><?php echo ucfirst(htmlentities($comment->author));?></p>
		    		<p style="line-height: 5px"><?php echo ucfirst(strip_tags($comment->body,'<strong><em><p>'));?></p>
		    		<p style="line-height: 3px;font-size: 12"><?php echo htmlentities($comment->time);?></p>
		    	</div>
		    <?php endforeach;?>
		<?php else:?>
			No comment
		<?php endif;?>
	    	</div>

	   </div>
    	


<?php if(isset($database)) { $database->close_connection(); } ?>
<?php include_layouts_template_n("footer.php");?>
<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
$id = isset($_GET['id'])?$_GET['id']:0;
$photo = Photograph::find_by_id($id);

if(!$photo){
	redirect_to("index.php");
}


$comments = $photo->comments();


?>

<?php include_layouts_template("admin_header.php");?>

    <div class="contaner" style="">
  	 <div class="col-md-6">
    	<img class="responsive" style="width: 600;" src="<?php echo "../images/".$photo->filename;?>" alt="...">
    </div>
    	<div class="col-md-5">
    		<h4 style="margin-top: 0">All Comments</h4>
			<div>
	    	<?php if($comments):?>
	    	<?php foreach($comments as $comment):?>
		    	<div style="margin-bottom: 20px;">
		    		<p style="line-height: 5px;font-weight: bold;"><?php echo ucfirst(htmlentities($comment->author));?></p>
		    		<p style="line-height: 5px"><?php echo strip_tags($comment->body,'<strong><em><p>')?></p>
		    		<p style="line-height: 3px;font-size: 12"><?php echo htmlentities($comment->time);?></p>
		    		<a style="color: red" href="delete_comment.php?id=<?php echo $comment->id;?>" onClick="return confirm('Are you sure to delete this photo?')">Delete</a>
		    	</div>
		    <?php endforeach;?>
		<?php else:?>
			No comment
		<?php endif;?>
	    	</div>

	   </div>
 
    	


<?php include_layouts_template("admin_footer.php");?>
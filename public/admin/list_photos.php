<?php
require_once('../../includes/initializer.php');
if(!$session->is_logged_in()){redirect_to("login.php");}
?>

<?php
	//.........current page
	$current_page = !empty($_GET['page'])?$_GET['page']:1;
	//........per page
	$per_page = 4;
	//........total count
	$total_count = Photograph::count_all();

	//.......pagination class
	$pagination = new Pagination($per_page,$current_page,$total_count);

	$sql = "SELECT * FROM Photographs LIMIT {$per_page} OFFSET {$pagination->offset()}";



	$photos = Photograph::find_by_sql($sql);
	$show = count($photos);
?>

<?php include_layouts_template("admin_header.php");?>
   <div class="contaner">

   		<div class="raw">	
		    
		    <div class="col-md-12">
		    <a style="color: green;" href="index.php">&laquo; Back</a>
			  	<h3 style="margin-top: 0px;">Photos</h3>
			  	<h3 style="color: blue;font-weight: bold;margin: 0"><?php echo $session->message(); ?></h3>	
			  	<a style="margin-bottom: 5px;" class="btn btn-info btn-sm" href="photo_upload.php">Upload Photo</a>
					<table class="table">
					<tr>
						<th>Image</th>
						<th>Name</th>
						<th>Size</th>
						<th>Type</th>
						<th>Comments</th>
						<th>Action</th>
					</tr>
					<?php foreach($photos as $photo):?>
					<tr>
						<td>
						<img src="<?php echo "../images/".$photo->filename; ?>" style="width: 100" alt="No image"></td>
						<td><?php echo htmlentities($photo->filename)?></td>
						<td><?php echo htmlentities($photo->size_as_text())?></td>
						<td><?php echo htmlentities($photo->type)?></td>
						<td><a href="photo_comment.php?id=<?php echo $photo->id;?>"><?php echo count($photo->comments());?></a></td>
						<td><a href="delete_photo.php?id=<?php echo $photo->id;?>" onClick="return confirm('Are you sure to delete this photo?')">Delete</a></td>
					</tr>
				<?php endforeach;?>
					</table>

					<a class="btn btn-info btn-sm" href="photo_upload.php">Upload Photo</a>
			</div>
		</div>	

	<!-- PAGINATION -->
	  <div class="col-xs-12" style="text-align: center;">
	    <nav aria-label="Page navigation">
	  		<ul class="pagination">
			  	<?php if($pagination->total_page() > 1):?>
			  		<?php if($pagination->has_previous_page()):?>
			  			<li class="page-item"> <a href="list_photos.php?page=<?php echo $pagination->previous_page();?>">&laquo; Previous</a></li>
			  		<?php endif;?>

			  		<?php for($i=1; $i<=$pagination->total_page(); $i++):?>
			  			<?php if($current_page == $i):?>
			  				<li class="page-item"><a style="background-color: #E84C3D;color: white;" ><?php echo $i;?></a> </li>
			  			<?php else:?>
			  				<li class="page-item"> <a href="list_photos.php?page=<?php echo $i?>"><?php echo $i;?></a></li>
			  			<?php endif;?>
			  		<?php endfor;?>

				  		<?php if($pagination->has_next_page()):?>
				  			<li class="page-item"> <a href="list_photos.php?page=<?php echo $pagination->next_page();?>">Next &raquo;</a></li>
				  		<?php endif;?>
				  	<?php endif;?>
		  	  </ul>

		</nav>

		<p>
	
			<?php 
				echo "Showing ". ($pagination->offset()+1) ." to ". ($pagination->offset()+$show) ." of {$total_count} entries"; 

			?>
		</p>

	  </div>

	  <!-- PAGINATION END-->

	</div>
<?php include_layouts_template("admin_footer.php");?>
<?php
require_once('../includes/session.php');
require_once('../includes/database.php');
require_once('../includes/database_object.php');
require_once('../includes/functions.php');
require_once('../includes/user.php');
require_once('../includes/photograph.php');
require_once('../includes/pagination.php');

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

<?php include_layouts_template_n("header.php");?>

    
<div class="contaner">
<h3 class="panel-heading info">Photo Gallery</h3>
<?php foreach($photos as $photo):?>
  <div class="col-xs-6 col-md-3">
    <a href="full_photo.php?id=<?php echo $photo->id;?>" class="thumbnail">
      <img src="<?php echo "images/".$photo->filename;?>" alt="...">
    </a>
    <p style="text-align: center;"><?php echo htmlentities($photo->caption);?></p>
  </div>
  
  <?php endforeach;?>

<!-- PAGINATION -->
  <div class="col-xs-12" style="text-align: center;">
    <nav aria-label="Page navigation" >
  		<ul class="pagination" style="margin-bottom: 5px;">
		  	<?php if($pagination->total_page() > 1):?>
		  		<?php if($pagination->has_previous_page()):?>
		  			<li class="page-item"> <a href="index.php?page=<?php echo $pagination->previous_page();?>">&laquo; Previous</a></li>
		  		<?php endif;?>

		  		<?php for($i=1; $i<=$pagination->total_page(); $i++):?>
		  			<?php if($current_page == $i):?>
		  				<li class="page-item"><a style="background-color: #E84C3D;color: white;" ><?php echo $i;?></a> </li>
		  			<?php else:?>
		  				<li class="page-item"> <a href="index.php?page=<?php echo $i?>"><?php echo $i;?></a></li>
		  			<?php endif;?>
		  		<?php endfor;?>

		  		<?php if($pagination->has_next_page()):?>
		  			<li class="page-item"> <a href="index.php?page=<?php echo $pagination->next_page();?>">Next &raquo;</a></li>
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
 
<?php if(isset($database)) { $database->close_connection(); } ?>
<?php include_layouts_template_n("footer.php");?>
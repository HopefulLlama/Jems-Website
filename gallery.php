<?php
	require_once 'header.php';

	if(isset($_GET['id'])){
		require_once 'db-handler.php';
		require_once 'class_image.php';
		$images = array();
		
		// Get all galleries as required to populate the nav-menu 
		// then store in an array if for later convenience.
	
		require_once './db-handler.php';
		$query = "SELECT id, title, client, produced FROM image WHERE gallery_id=".$_GET['id'].";";
		openConnDb();
		
		$results = mysqli_query($conn, $query);
		if($results->num_rows>0){
			while($obj = mysqli_fetch_object($results)) {
				array_push($images, new Image($obj->id, $obj->title, $obj->client, $obj->produced));			
			}
		}
	} else {
		header('Location: gallery-menu.php');
	}

	foreach ($images as $image){
?>
<!-- Image Modal -->
<div class="modal fade" id="imageModal-<?php echo $image->id; ?>" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel-<?php echo $image->id; ?>" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="imageModalLabel-<?php echo $image->id; ?>"><?php echo $image->title; ?></h4>
            </div>
            <div class="modal-body">
            	<img class="dynamic" src="/example/get-image-image.php?id=<?php echo $image->id; ?>">
            </div>
            <div class="modal-footer">
            	<div class="row">
            		<div class="col-sm-8 col-md-8">
            			<div class="table-responsive">
	                    	<table class="table table-hover table-condensed small">
	                    		<tr><td><b>Title: </b></td><td><?php echo $image->title; ?></td></tr>
	                    		<tr><td><b>Client: </b></td><td><?php echo $image->client; ?></td></tr>
	                    		<tr><td><b>Produced for: </b></td><td><?php echo $image->produced; ?></td></tr>
	                    	</table>
                		</div>
            		</div>
            		<div class="col-sm-4 col-md-4">
                		<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
            		</div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	}
?>
<div class="container">
	<div class="header">
		<h1 class="page-header"><?php
			foreach($galleries as $gallery){
				if($gallery->id == $_GET['id']){
					echo $gallery->name;
				}
			}
		?></h1>
	</div>
		<?php
			if(count($images) == 0){
		?>
		<p>No images yet. Please check back later.</p>
		<?php 
			} else {
		?>
		<div class="row">
		<?php
				foreach($images as $image){
		?>
		<div class="col-sm-4 col-md-2">
	    	<div class="galleryItem thumbnail">
	      		<img data-toggle="modal" data-target="#imageModal-<?php echo $image->id; ?>" src="/example/get-image-image.php?id=<?php echo $image->id; ?>">
			</div>
	  	</div>
	  	<?php
				}
			}
	  	?>
	</div>
</div>
<?php
	require_once 'footer.php';
?>
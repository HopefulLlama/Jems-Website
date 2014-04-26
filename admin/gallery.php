<?php
	require_once 'header.php';
	
	if(!isset($_SESSION['currentUser'])){
		header('Location: ./login.php');
	}
	
	if(isset($_GET['id'])){
		require_once './../class_gallery.php';
		require_once './../db-handler.php';
		$query = "SELECT id, name, description FROM gallery WHERE id = ".$_GET['id'].";";
		openConnDb();
		$results = mysqli_query($conn, $query);
		if($results->num_rows==1){
			while($obj = mysqli_fetch_object($results)) {
				$gallery = new Gallery($obj->id, $obj->name, $obj->description);
			}			
		}
	} else {
		header('Location: ./login.php');
	}
	
?>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="deleteModalLabel">Delete Operation</h4>
            </div>
            <div class="modal-body">
            	Warning: The delete operation is irreversible. Deleted data cannot be restored. Continue?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            	<a id="confirm-delete-button" href="" type="button" class="btn btn-success">Continue</a>
            </div>
        </div>
    </div>
</div>

<div class="container">
	<h1 class="page-header"><? echo $gallery->name; ?></h1>
	<?php if(isset($_SESSION['imageReturnMessage'])){
		echo $_SESSION['imageReturnMessage'];
		unset($_SESSION['imageReturnMessage']);
	}?>
	<div class="panel panel-success">
		<div class="btn panel-heading add panel-button" data-target="#add-image-panel">+ Add a new image to this gallery</div>
			<div id="add-image-panel" class="panel-body toggle-panel">
	    		<form enctype="multipart/form-data" class="form-horizontal" role="form" method="post" action="./functions/add-image.php">
	    			<input type="hidden" name="gallery-id" value="<?php echo $gallery->id; ?>">
			  		<div class="form-group">
			    		<label for="inputTitle" class="col-sm-2 control-label">Title</label>
			    		<div class="col-sm-10">
			      			<input name="inputTitle" type="text" class="form-control" id="inputTitle" placeholder="Title">
			    		</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="inputClient" class="col-sm-2 control-label">Client</label>
					    <div class="col-sm-10">
				      		<input name="inputClient" type="text" class="form-control" id="inputClient" placeholder="Client">
					    </div>
				  	</div>
		  			<div class="form-group">
			    		<label for="inputProduced" class="col-sm-2 control-label">Produced</label>
					    <div class="col-sm-10">
				      		<input name="inputProduced" type="text" class="form-control" id="inputProduced" placeholder="Produced for...">
					    </div>
				  	</div>
				  	<div class="form-group">
						<label for="inputImage" class="col-sm-2 control-label">Image</label>
					    <div class="col-sm-10">
				      		<input name="inputImage" type="file" class="form-control" id="inputImage">
					    </div>
				  	</div>
				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-10">
				      		<button name="submitAddImage" type="submit" class="btn btn-default">Add Image</button>
					    </div>
				  	</div>
			</form>
		</div>
	</div>
	
	<div class="row">
	<?php
		require_once './../db-handler.php';
		$query = "SELECT id, title, client, produced FROM image WHERE gallery_id=".$gallery->id.";";
		openConnDb();
		
		$results = mysqli_query($conn, $query);
		if($results->num_rows>0){
			while($obj = mysqli_fetch_object($results)) {
	?>
		<div id="image-<?php echo $obj-> id; ?>" class="col-sm-6 col-md-4">
	    	<div class="imageItem thumbnail">
		      	<img src="/example/get-image-image.php?id=<?php echo $obj-> id; ?>">
	      		<div class="caption">
	        		<div class="table-responsive">
	                    	<table class="table table-hover table-condensed small">
	                    		<tr><td><b>Title: </b></td><td><?php echo $obj->title; ?></td></tr>
	                    		<tr><td><b>Client: </b></td><td><?php echo $obj->client; ?></td></tr>
	                    		<tr><td><b>Produced for: </b></td><td><?php echo $obj->produced; ?></td></tr>
	                    	</table>
                		</div>
	        		<a id="delete-image-<?php echo $obj-> id; ?>" class="btn btn-danger panel-button delete-image-button" role="button">Delete</a>
	        		
	        		<!-- Edit panel -->
	        		
					<div class="panel panel-default">
						<div class="btn panel-heading edit panel-button" data-parent="#image-<?php echo $obj->id; ?>" data-target="#edit-image-panel-<?php echo $obj->id; ?>">Edit</div>
							<div id="edit-image-panel-<?php echo $obj-> id; ?>" class="panel-body toggle-panel">
					    		<form enctype="multipart/form-data" class="form-horizontal" role="form" method="post" action="./functions/edit-image.php">
					    			<input type="hidden" name="gallery-id" value="<?php echo $gallery->id; ?>">
					    			<input type="hidden" name="id" value="<?php echo $obj-> id; ?>">
							  		<div class="form-group">
							    		<label for="editTitle-<?php echo $obj->id; ?>" class="col-sm-2 control-label">Title</label>
							    		<div class="col-sm-10">
							      			<input name="editTitle-<?php echo $obj-> id; ?>" type="text" class="form-control" id="editTitle-<?php echo $obj->id; ?>" placeholder="Title" value="<?php echo $obj->title; ?>">
							    		</div>
							  		</div>
							  		<div class="form-group">
							    		<label for="editClient-<?php echo $obj->id; ?>" class="col-sm-2 control-label">Client</label>
							    		<div class="col-sm-10">
							      			<input name="editClient-<?php echo $obj-> id; ?>" type="text" class="form-control" id="editClient-<?php echo $obj->id; ?>" placeholder="Client" value="<?php echo $obj->client; ?>">
							    		</div>
							  		</div>
							  		<div class="form-group">
							    		<label for="editProduced-<?php echo $obj-> id; ?>" class="col-sm-2 control-label">Produced</label>
									    <div class="col-sm-10">
								      		<input name="editProduced-<?php echo $obj-> id; ?>" type="text" class="form-control" id="editProduced-<?php echo $obj->id; ?>" placeholder="Produced" value="<?php echo $obj->produced; ?>">
									    </div>
								  	</div>
								  	<div class="form-group">
										<label for="editImage-<?php echo $obj-> id; ?>" class="col-sm-2 control-label">Image</label>
									    <div class="col-sm-10">
								      		<input name="editImage-<?php echo $obj-> id; ?>" type="file" class="form-control" id="editImage-<?php echo $obj->id; ?>">
									    </div>
								  	</div>
								  	<div class="form-group">
								    	<div class="col-sm-offset-2 col-sm-10">
								      		<button name="submitEditImage" type="submit" class="btn btn-default">Submit</button>
									    </div>
								  	</div>
							</form>
						</div>
					</div>
					
	      		</div>
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
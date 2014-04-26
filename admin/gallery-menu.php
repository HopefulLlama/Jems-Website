<?php
	require_once 'header.php';
	
	if(!isset($_SESSION['currentUser'])){
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
	<h1 class="page-header">Galleries</h1>
	<?php if(isset($_SESSION['galleryReturnMessage'])){
		echo $_SESSION['galleryReturnMessage'];
		unset($_SESSION['galleryReturnMessage']);
	}?>
	<div class="panel panel-success">
		<div class="btn panel-heading add panel-button" data-target="#add-gallery-panel">+ Add a new gallery</div>
			<div id="add-gallery-panel" class="panel-body toggle-panel">
	    		<form enctype="multipart/form-data" class="form-horizontal" role="form" method="post" action="./functions/add-gallery.php">
			  		<div class="form-group">
			    		<label for="inputName" class="col-sm-2 control-label">Name</label>
			    		<div class="col-sm-10">
			      			<input name="inputName" type="text" class="form-control" id="inputName" placeholder="Name">
			    		</div>
			  		</div>
			  		<div class="form-group">
			    		<label for="inputDescription" class="col-sm-2 control-label">Description</label>
					    <div class="col-sm-10">
				      		<input name="inputDescription" type="text" class="form-control" id="inputDescription" placeholder="Description">
					    </div>
				  	</div>
				  	<div class="form-group">
						<label for="inputThumbnail" class="col-sm-2 control-label">Thumbnail</label>
					    <div class="col-sm-10">
				      		<input name="inputThumbnail" type="file" class="form-control" id="inputThumbnail">
					    </div>
				  	</div>
				  	<div class="form-group">
				    	<div class="col-sm-offset-2 col-sm-10">
				      		<button name="submitAddGallery" type="submit" class="btn btn-default">Add Gallery</button>
					    </div>
				  	</div>
			</form>
		</div>
	</div>
	
	<div class="row">
	<?php
		require_once './../db-handler.php';
		$query = "SELECT id, name, description FROM gallery;";
		openConnDb();
		
		$results = mysqli_query($conn, $query);
		if($results->num_rows>0){
			while($obj = mysqli_fetch_object($results)) {
	?>
		<div id="gallery-<?php echo $obj-> id; ?>" class="col-sm-6 col-md-4">
	    	<div class="galleryItem thumbnail">
		      	<a href="./gallery?id=<?php echo $obj-> id; ?>"><img src="/example/get-gallery-image.php?id=<?php echo $obj-> id; ?>"></a>
	      		<div class="caption">
	        		<h3><?php echo $obj->name; ?></h3>
	        		<p><?php echo $obj->description; ?></p>
	        		<a href="./gallery?id=<?php echo $obj-> id; ?>" class="btn btn-primary panel-button" role="button">View</a>
	        		<a id="delete-gallery-<?php echo $obj-> id; ?>" class="btn btn-danger panel-button delete-gallery-button" role="button">Delete</a>
	        		
	        		<!-- Edit panel -->
	        		
	        		<div class="panel panel-default">
						<div class="btn panel-heading edit panel-button" data-parent="#gallery-<?php echo $obj-> id; ?>" data-target="#edit-gallery-panel-<?php echo $obj-> id; ?>">Edit</div>
							<div id="edit-gallery-panel-<?php echo $obj-> id; ?>" class="panel-body toggle-panel">
					    		<form enctype="multipart/form-data" class="form-horizontal" role="form" method="post" action="./functions/edit-gallery.php">
					    			<input type="hidden" name="id" value="<?php echo $obj-> id; ?>">
							  		<div class="form-group">
							    		<label for="editName-<?php echo $obj-> id; ?>" class="col-sm-2 control-label">Name</label>
							    		<div class="col-sm-10">
							      			<input name="editName-<?php echo $obj-> id; ?>" type="text" class="form-control" id="editName-<?php echo $obj-> id; ?>" placeholder="Name" value="<?php echo $obj-> name; ?>">
							    		</div>
							  		</div>
							  		<div class="form-group">
							    		<label for="editDescription-<?php echo $obj-> id; ?>" class="col-sm-2 control-label">Description</label>
									    <div class="col-sm-10">
								      		<input name="editDescription-<?php echo $obj-> id; ?>" type="text" class="form-control" id="editDescription-<?php echo $obj-> id; ?>" placeholder="Description" value="<?php echo $obj-> description; ?>">
									    </div>
								  	</div>
								  	<div class="form-group">
										<label for="editThumbnail-<?php echo $obj-> id; ?>" class="col-sm-2 control-label">Thumbnail</label>
									    <div class="col-sm-10">
								      		<input name="editThumbnail-<?php echo $obj-> id; ?>" type="file" class="form-control" id="editThumbnail-<?php echo $obj-> id; ?>">
									    </div>
								  	</div>
								  	<div class="form-group">
								    	<div class="col-sm-offset-2 col-sm-10">
								      		<button name="submitEditGallery" type="submit" class="btn btn-default">Submit</button>
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
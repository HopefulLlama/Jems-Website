<?php
	require_once 'header.php';
?>
<div class="container">
	<div class="header">
		<h1 class="page-header">
			Gallery
		</h1>
	</div>
	<div class="row">
		<?php
			foreach($galleries as $gallery){
		?>
			<div id="gallery-<?php echo $gallery->id; ?>" class="col-sm-6 col-md-4">
		    	<div class="galleryItem thumbnail">
			      	<a href="./gallery.php?id=<?php echo $gallery->id; ?>"><img src="/example/get-gallery-image.php?id=<?php echo $gallery->id; ?>"></a>
		      		<div class="caption">
		        		<h3><?php echo $gallery->name; ?></h3>
		        		<p><?php echo $gallery->description; ?></p>
		        	</div>
		    	</div>
		  	</div>
	  	<?php
			}
		?>
	</div>
</div>
<?php
	require_once 'footer.php';
?>
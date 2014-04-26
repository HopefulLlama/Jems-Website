function initialiseDeleteGalleryButtons(){
	$(".delete-gallery-button").each(function(){
		$(this).click(function(){
			var id=$(this).attr("id").replace('delete-gallery-', ''); 
			$("#confirm-delete-button").attr("href", "./functions/delete-gallery.php?id="+id);
			$("#deleteModal").modal('show');
		});
	});
}

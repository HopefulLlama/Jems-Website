function initialiseDeleteButtons(){
	$(".delete-button").each(function(){
		$(this).click(function(){
			var id=$(this).attr("id").replace('delete-', ''); 
			$("#confirm-delete-button").attr("href", "./functions/delete-gallery.php?id="+id);
			$("#deleteModal").modal('show');
		});
	});
}

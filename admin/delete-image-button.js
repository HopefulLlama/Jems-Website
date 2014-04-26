function initialiseDeleteImageButtons(){
	$(".delete-image-button").each(function(){
		$(this).click(function(){
			var id=$(this).attr("id").replace('delete-image-', '');
			
			var parameter = window.location.search.replace( "?", "" ); // will return the GET parameter 
			var values = parameter.split("=");
			var galleryId = values[1];		 
			 
			$("#confirm-delete-button").attr("href", "./functions/delete-image.php?id="+id+"&galleryId="+galleryId);
			$("#deleteModal").modal('show');
		});
	});
}

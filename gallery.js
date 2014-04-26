function initialiseGalleryItems(){
	fadeGalleryItems();
	assignGalleryItemsEvents();
}

function fadeGalleryItems(){
	$(".galleryItem").each(function(){
		$(this).fadeTo(0, animateTime);
	});
}

function assignGalleryItemsEvents(){
	$(".galleryItem").each(function(){
		$(this).mouseover(function(){
			$(this).fadeTo(0.5, 1);
		});
		
		$(this).mouseout(function(){
			$(this).fadeTo(0.5, animateTime);
		});
	});
}

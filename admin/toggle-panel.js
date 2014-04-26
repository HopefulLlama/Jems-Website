function initialiseTogglePanels(){
	$(".add").each(function(){
		$(this).click(function(){
			var target=$(this).attr("data-target"); 
			if($(target).css("display") != "none"){
				$(target).css("display", "none");
			} else {
				$(target).css("display", "block");
			}
		});
	});
	
	$(".edit").each(function(){
		$(this).click(function(){
			var target=$(this).attr("data-target");
			var parent=$(this).attr("data-parent"); 
			if($(target).css("display") != "none"){
				$(target).css("display", "none");
				$(parent).removeClass("col-sm-12");
				$(parent).removeClass("col-md-6");
				$(parent).addClass("col-sm-6");
				$(parent).addClass("col-md-4");
			} else {
				$(target).css("display", "block");
				$(parent).removeClass("col-sm-6");
				$(parent).removeClass("col-md-4");
				$(parent).addClass("col-sm-12");
				$(parent).addClass("col-md-6");
			}
		});
	});
	
	
	$(".toggle-panel").each(function(){
		$(this).css("display", "none");
	});
}

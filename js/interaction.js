function loadingAnimation(stop)
{
	if(stop)
	{
		$("body").append("<div class=\"loading-animation\"><img src=\"./img/loading.png\" alt=\"loading animation\"></div>");
	}
	else
	{
		$(".loading-animation").fadeOut("fast");
	}
}

$(document).ready(function() 
{

	$.fn.preload = function() 
	{
		this.each(function() {
			$('<img/>')[0].src = this;
		});
	}

	// Usage:

	$(['./img/loading.png']).preload();
	
	
	$(".room-name-form").submit(function(e){
		e.preventDefault();
		var name = $(".room-name-form input").val();
		loadingAnimation(true);
		$.get("index.php", {room: name}, 
		function(data)
		{
			loadingAnimation(false);
			$("body").html(data);
		});
	});
	
	
});

var togglePic = function() {
	$(".userbox").each(function()
	{
		$(".avatar img.visible").removeClass().next().add(".avatar img:first")
		.last().addClass("visible");
	});
}
setInterval(togglePic, 1000);
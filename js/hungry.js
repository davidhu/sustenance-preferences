$(function(){
	$(".clickable").click(function(e) {
			window.document.location = $(this).data("href");
	});
});

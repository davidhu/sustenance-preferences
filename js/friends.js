$(function(){
	$('.add').click(function(){
		$.get("api/add_friend.php?uid="+$(this).children().val());
		
		$(this).parent().children().show();
		$(this).hide();


	});

	$('.remove').click(function(e){
		$.get("api/remove_friend.php?uid="+$(this).children().val());

		$(this).parent().children().show();
		$(this).hide();

	});
	
	$(".clickable").click(function(e) {
		if (e.target.nodeName != 'A') {
			window.document.location = $(this).data("href");
		}
	});
});

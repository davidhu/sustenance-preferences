$(function(){
	$('.add').click(function(){
		$.get("api/add_friend.php?uid="+$(this).children().val());
		
		$(this).parent().children().show();
		$(this).hide();

	});

	$('.remove').click(function(){
		$.get("api/remove_friend.php?uid="+$(this).children().val());

		$(this).parent().children().show();
		$(this).hide();
	});
});

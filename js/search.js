$(function(){
	$('.btn-success').click(function(){
		$.get("api/add_friend.php?uid="+$(this).children().val());
		
		alert("success");

	});
});

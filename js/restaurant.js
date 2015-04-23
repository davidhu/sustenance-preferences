

$(function(){
	$('.rec').click(function(){
		$.get("api/recommend.php?rid="+$('#rid').val()+"&fid="+$(this).attr('value'));
		
		$(this).removeClass('btn-primary');
		$(this).addClass('btn-success');
		$(this).text('Already Recommended');
		$(this).attr('disabled','disabled');
	});

	$('.remove').click(function(){
		$.get("api/remove_friend.php?uid="+$(this).children().val());

		$(this).parent().children().show();
		$(this).hide();
	});
});

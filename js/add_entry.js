var delish;

function enableForm(){
	if ($('.btn-primary').size() == 1) {
		$('.btn-success').removeAttr("disabled");
	} else {
		$('.btn-success').attr("disabled", "disabled");
	}
}


$(function(){
	$('#delish').click(function(){
		$(this).toggleClass("btn-primary");
		delish = 'y';
		$('#notdelish').removeClass("btn-primary");
		enableForm();
	});
	$('#notdelish').click(function(){
		$(this).toggleClass("btn-primary");
		delish = 'n';
		$('#delish').removeClass("btn-primary");
		enableForm();
	});

	$('.submit').click(function(e){
		e.preventDefault();
		


		$.get("api/add_entry.php?rid="+$('#rid').val()+"&fid="+$('#fid').val()+"&delish="+delish, function() {
			window.location = "diary.php";
		});
		
	});
});

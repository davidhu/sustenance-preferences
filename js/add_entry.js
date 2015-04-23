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
		$('#notdelish').removeClass("btn-primary");
		enableForm();
	});
	$('#notdelish').click(function(){
		$(this).toggleClass("btn-primary");
		$('#delish').removeClass("btn-primary");
		enableForm();
	});


});

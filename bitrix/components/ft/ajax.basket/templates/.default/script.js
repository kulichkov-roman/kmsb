$(function() {
	$('#basker-form #remember').click(function() {
		var checked = false;
		if($(this).is(':checked')) {
			checked = true;
		}
		$('#basker-form ul li.register-field').each(function() {
			if(checked) {
				$(this).show();
				$(this).find('input').addClass('required');
			} else {
				$(this).hide();
				$(this).find('input').removeClass('required');
			}
		});
	});
});
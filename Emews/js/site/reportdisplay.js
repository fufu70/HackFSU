jQuery(function () {
	var id = '#' + $('#formname').val();
	$(id).addClass('active');
	$(id).parent().parent().addClass('in');
	$('table').footable({
		breakpoints: {
			phone: 500,
			tablet: 650
		}
	});
});
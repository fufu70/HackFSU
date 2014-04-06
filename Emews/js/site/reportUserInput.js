jQuery(function () {
	$(document).ready(function() {
		var id = '#' + $('#formname').val();
		var activeItem = $('.switch-link').has('a[href=' + id + ']');
		activeItem.addClass('active');
		activeItem.parent().parent().addClass('in');
		switchForm(id);
	});
	$('.switch-link').click(function(e) {
		e.preventDefault();
		$('.switch-link.active').removeClass('active');
		$(this).addClass('active');
		switchForm($(this).children().attr('href'));
	});
	function switchForm(id) {
		$('.report-form').each(function() {
			$(this).get(0).reset();
		});
		$('.chosen').trigger('chosen:updated');
		$('.switch-group').not('.hide').addClass('hide');
		$(id).removeClass('hide');
	}
	$('.chosen').chosen({
		placeholder_text_single: ' ',
		disable_search_threshold: 8,
		allow_single_deselect: false,
		width: '100%',
	});
	$('.Date').datetimepicker({
		pickTime: false
	});
});
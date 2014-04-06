jQuery(function($) {
	$(document).ready(function() {
		var id = '#' + $('#formname').val();
		$('.switch-link').has('a[href=' + id + ']').addClass('active');
		switchForm(id);
		$('#success_alert').delay(3000).fadeOut(1000);
	});
	$('.switch-link').click(function(e) {
		e.preventDefault();
		$('.switch-link.active').removeClass('active');
		$(this).addClass('active');
		switchForm($(this).children().attr('href'));
	});
	function switchForm(id) {
		$('.form-add').each(function() {
			$(this).get(0).reset();
		});
		$('.chosen').trigger('chosen:updated');
		$('.switch-group').not('.hide').addClass('hide');
		$(id).removeClass('hide');
	}
	$('input,select,textarea').not('[type=submit]').jqBootstrapValidation();
	$('.phone').mask('(999) 999-9999');
	$('.chosen').chosen({
		placeholder_text_single: ' ',
		disable_search_threshold: 8,
		allow_single_deselect: false,
		width: '100%',
	});
	$('.Date').datetimepicker({
		pickTime: false
	});
	$('.Time').datetimepicker({
		pickDate: false
	});
});
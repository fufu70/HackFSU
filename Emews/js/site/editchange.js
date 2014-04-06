jQuery(function($) {
	$('.form-edit').submit(function(event) {
    	$('#EditForm_roleName').prop('disabled', false);
	});
	$('input,select,textarea').not('[type=submit]').jqBootstrapValidation();
	$('.chosen').chosen({
		placeholder_text_single: ' ',
		disable_search_threshold: 8,
		allow_single_deselect: false,
		width: '100%',
	});
	$('.phone').mask('(999) 999-9999');
	$('.Date').datetimepicker({
		pickTime: false
	});
});
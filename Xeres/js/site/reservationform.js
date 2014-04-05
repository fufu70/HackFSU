jQuery(function($) {
    $("#ReservationForm_primaryEmail*").chosen({
        placeholder_text_single: " ",
        search_contains: true,
		width: "100%",
    });
    $("#ReservationForm_secondaryEmail*").chosen({
        placeholder_text_single: " ",
        search_contains: true,
        allow_single_deselect: true,
		width: "100%",
    });
    $("#ReservationForm_buildingName*").chosen({
        placeholder_text_single: " ",
        enable_split_word_search: true,
		width: "100%",
    });
    $("#ReservationForm_equipmentNew, #ReservationForm_equipmentEdit").chosen({
        placeholder_text_multiple: "Type To Search",
        enable_split_word_search: true,
		display_disabled_options: false,
        max_selected_options: 5,
		width: "100%",
    });
	$("#filter_equipment*").chosen({
        enable_split_word_search: true,
        allow_single_deselect: true,
		width: "100%",
    });
	// Filters option groups within the equipment dropdown by disabling them
	$("#filter_equipment*").change(function() {
		if ($(this).val() == "All") {
			// Show all groups
			$("option", this).each(function() {
				$("#itemGroup_" + $(this).val() + "*").prop("disabled", false);
			});
		} else {
			var selected = $(this).val();
			$("option", this).each(function() {
				if ($(this).val() != selected) {
					// Hide group
					$("#itemGroup_" + $(this).val() + "*").prop("disabled", true);
				} else {
					// Show group
					$("#itemGroup_" + $(this).val() + "*").prop("disabled", false);
				}
			});
		}
		// Notify the plugin that the options have changed
		$("#ReservationForm_equipmentNew").trigger("chosen:updated");
		$("#ReservationForm_equipmentEdit").trigger("chosen:updated");
	});
	// Equipment selections will NOT submit if disabled, thus when the form is submitted, 
	// this function enables all the equipment options hidden by the filter
	$('.form-signin').submit(function(event) {
		$("#filter_equipment*").val('All').trigger("change").trigger("chosen:updated");
	});
    $('.Date').datetimepicker({
      pickTime: false
    });
    $('.Time').datetimepicker({
        pick12HourFormat: true,
        pickSeconds: false,
        pickDate: false
    });
});
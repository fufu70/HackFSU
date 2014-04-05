
<!-- Content -->
<div class="col-xs-12 col-sm-12 col-md-12">
	<!-- Toggle Button Bar -->
	<div class="row">
		<div class="btn-group btn-group-xs btn-group-justified" data-toggle="buttons">
			<label class="btn btn-default" id="ready_label">
				<input type="checkbox" id="ready_toggle"><h4 class="text-success">Ready</h4></input>
			</label>
			<label class="btn btn-default" id="active_label">
				<input type="checkbox" id="active_toggle"><h4 class="text-danger">Active</h4></input>
			</label>
			<label class="btn btn-default" id="overdue_label">
				<input type="checkbox" id="overdue_toggle"><h4 class="text-warning">Overdue</h4></input>
			</label>
			<label class="btn btn-default" id="closed_label">
				<input type="checkbox" id="closed_toggle"><h4 class="text-muted">Closed</h4></input>
			</label>
		</div>
	</div><!-- ./toggle button bar -->
	<div class="row margin-small">
		<div id='calendar' style='font-size:13px' class="fc fc-ltr"></div>
	</div>
</div><!-- ./content -->

<!-- Action Modal -->
<div class="modal fade" id="action_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body row">
				<div class="col-xs-6 form-group">
					<a id="edit_button" class="btn btn-default btn-lg btn-block" role="button">Edit Reservation</a>
				</div>
				<div class="col-xs-6 form-group">
					<a id="checkout_button" class="btn btn-default btn-lg btn-block" role="button">Checkout Reservation</a>
				</div>
				<div class="col-xs-6 form-group">
					<a id="close_button" class="btn btn-default btn-lg btn-block" role="button">Close Reservation</a>
				</div>
				<div class="col-xs-6 form-group">
					<a id="agreement_button" class="btn btn-default btn-lg btn-block" role="button">Print Loan Agreement</a>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.action modal -->

<script type="text/javascript">
	jQuery(function($)
	{
		$('#ready_label, #active_label, #closed_label, #overdue_label').tooltip({
			animation: false,
			placement: 'bottom',
			delay: { show: 200, hide: 0 },
			trigger: 'hover',
			container: 'body',
		});
		$('#ready_label').data('bs.tooltip').options.title = function() {
			if ($('#ready_toggle').is(':checked')) {
				return 'Show Ready Reservations';
			} else {
				return 'Hide Ready Reservations';
			}
		};
		$('#active_label').data('bs.tooltip').options.title = function() {
			if ($('#active_toggle').is(':checked')) {
				return 'Show Active Reservations';
			} else {
				return 'Hide Active Reservations';
			}
		};
		$('#closed_label').data('bs.tooltip').options.title = function() {
			if ($('#closed_toggle').is(':checked')) {
				return 'Show Closed Reservations';
			} else {
				return 'Hide Closed Reservations';
			}
		};
		$('#overdue_label').data('bs.tooltip').options.title = function() {
			if ($('#overdue_toggle').is(':checked')) {
				return 'Show Overdue Reservations';
			} else {
				return 'Hide Overdue Reservations';
			}
		};
		$('#ready_toggle').change(function() {
			toggleReservation(!this.checked, 'Ready');
			$('#ready_label').tooltip('hide');
			$('#ready_label').tooltip('show');
		});
		$('#active_toggle').change(function() {
			toggleReservation(!this.checked, 'Active');
			$('#active_label').tooltip('hide');
			$('#active_label').tooltip('show');
		});
		$('#closed_toggle').change(function() {
			toggleReservation(!this.checked, 'Closed');
			$('#closed_label').tooltip('hide');
			$('#closed_label').tooltip('show');
		});
		$('#overdue_toggle').change(function() {
			toggleReservation(!this.checked, 'Overdue');
			$('#overdue_label').tooltip('hide');
			$('#overdue_label').tooltip('show');
		});
		// Sets the visibility of all reservations of a given status
		function toggleReservation(visible, status) {
			var eventList = $('#calendar').fullCalendar('clientEvents', function(calEvent) {
				return calEvent.status == status;
			});
			for (var i = 0; i < eventList.length; i++) {
				eventList[i].visible = visible;
				$('#calendar').fullCalendar('updateEvent', eventList[i]);
			}
		}
	});
		
	// Initialize the full-calendar jQuery plugin
	$('#calendar').fullCalendar({
        
		// Constructs and shows the action modal when an event is clicked
		eventClick: function(calEvent, jsEvent, view) {
			$('.modal-header h4').html('Reservation for <strong>' + calEvent.title + '</strong>');
			$('#edit_button').attr('href', '../rese/reservationedit?id=' + calEvent.id);
			$('#agreement_button').attr('href', '../rese/reservationagreement?id=' + calEvent.id);
			// if status is READY
			if (calEvent.status == 'Ready') {
				$('#checkout_button').attr('href', '../rese/reservationcheckout?id=' + calEvent.id);
				$('#checkout_button').parent().show();
				$('#close_button').parent().hide();
			// if status is ACTIVE or OVERDUE
			} else if (calEvent.status == 'Active' || calEvent.status == 'Overdue') {
				$('#close_button').attr('href', '../rese/reservationclose?id=' + calEvent.id);
				$('#close_button').parent().show();
				$('#checkout_button').parent().hide();
			// if status is CLOSED
			} else if (calEvent.status == 'Closed') {
				$('#checkout_button').parent().hide();
				$('#close_button').parent().hide();
			}
			$('#action_modal').modal({
				backdrop: true,
				keyboard: true
			});
		},
      
		// Only renders events that are visible
		eventRender: function(event, element) {
			return event.visible;
		},
			
		// Reduces the font-size of the title when the window is too small
		windowResize: function(view) {
			if ($('#calendar').width() < 500) {
				$('.fc-header-title h2').css({ 'font-size': '1.5em' });
			} else {
				$('.fc-header-title h2').css({ 'font-size': '2.4em' });
			}
		},

		// This sets up the calendar header
		header: {
			left: 'prev,next,today', 	// Date navigation buttons:  [ < ][ > ][ today ]
			center: 'title', 			// Title goes in the center
			right: 'month,basicWeek' 	// Different display modes: [ Month ][ Week ]
		},

		// Enables drag & drop if jQuery UI is linked to.
		editable: false,

		<?php
			// Fixes warnings regarding default timezone not being set.
			date_default_timezone_set("America/New_York");

			// Essentially we need the reservation #, status, the email of the person who made the reservation,
			// and finally the start & end date.
			$sqlquery = "
				SELECT `reservation_number`, s.`status` AS status, p.`email_address` AS email, r.`beginning_date` AS start_date, r.`end_date` AS end_date FROM `tbl_reservation` AS r
				INNER JOIN `tbl_people` AS p ON p.`people_id` = r.`people_id`
				INNER JOIN `tbl_reservation_status` AS s ON s.`reservation_status_id` = r.`reservation_status_id`";
			
			// Query the DB through Yii.
			$connection = Yii::app()->db;
			$command = $connection->createCommand($sqlquery);
			$res = $command->queryAll();

			// Status ID constants:
			// 1. Ready Reservation (Reservation was just created but no one has picked anything up yet).
			// 2. Active Reservation (They checked out the equipment).
			// 3. Overdue Reservation (Reservation is still active and the due date has passed).
			// 4. Closed Reservation (They brought their equipment back).
			define("STATUS_READY", "Ready");
			define("STATUS_ACTIVE", "Active");
			define("STATUS_OVERDUE", "Overdue");
			define("STATUS_CLOSED", "Closed");

			// Echo the 'events' property starter tag now so we can just echo events from within the loop.
			echo "events: [";
			
			// Loop through all of the reservations returned from the query above.
			for ($i = 0; $i < sizeof($res); $i++)
			{
				// Reservation # and Status ID for that reservation.
				$resNum = $res[$i]['reservation_number'];

				$status = $res[$i]['status'];

				// $title is what will be displayed on the actual event in the Full Calendar plugin
				$title = $res[$i]['email'];
				
				// Some objects to hold the full PHP date object so we can do date comparisons without
				// having to query again.
				$today = date('y-m-d');
				$start_date = date('y-m-d', strtotime($res[$i]['start_date']));
				$end_date = date('y-m-d', strtotime($res[$i]['end_date']));

				// Explode the Date objects into three parts... Since the date is stored as yyyy-mm-dd
				// in the database, if we explode it using the delimiter '-' then the result is an array
				// with three elements in it:
				// [0] = yyyy,
				// [1] = mm,
				// [2] = dd
				$sdate = explode('-', $res[$i]['start_date']);
				$edate = explode('-', $res[$i]['end_date']);
				
				// Change color & text color at the same time to make sure that the text is readable
				// on whatever color the event is.
				$color = "#b94a48";
				$textColor = "white";

				// This should never happen, since all reservations should have dates associated with them.
				if (sizeof($sdate) < 3 || sizeof($edate) < 3) {
					continue;
				}

				// Pick the colors!
				// 1. Green (Ready)
				// 2. Red (Active)
				// 3. Grey (Closed, Archived)
				// 4. Yellow (Overdue)
				if ($status == STATUS_READY) // Ready
				{
					$color = "#468847";
					$textColor = "white";
				}
				else if ($status == STATUS_ACTIVE && ($end_date >= $today)) // Active
				{
					$color = "#b94a48";
					$textColor = "white";
				}
				else if ($status == STATUS_CLOSED) // Closed, Archived
				{
					$color = "#bbb";
					$textColor = "black";
				}
				else if ($status == STATUS_ACTIVE && ($end_date < $today)) // Overdue
				{
					$color = "#e6b800";
					$textColor = "black";
					$status = STATUS_OVERDUE;
				}

				// Echo out the event object while injecting our custom properties.
				echo "{
					id: '". $res[$i]['reservation_number'] ."',
					status: '". $status ."',
					title: '". $title ."',
					start: new Date(". $sdate[0] .", ". ($sdate[1] - 1) .", ". $sdate[2] ."),
					end: new Date(". $edate[0] .", ". ($edate[1] - 1) .", ". $edate[2] ."),
					color: '". $color ."',
					textColor: '". $textColor ."',
					visible: true,
				},";
			}
			
			// Close the tag on the 'events' property.
			echo "]";
		?>
	});
</script> 

<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('reservation_number')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->reservation_number), array('view', 'id' => $data->reservation_number)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('people_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->people)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('secondary_contact_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->secondaryContact)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('beginning_date')); ?>:
	<?php echo GxHtml::encode($data->beginning_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('beginning_time')); ?>:
	<?php echo GxHtml::encode($data->beginning_time); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reservation_notes')); ?>:
	<?php echo GxHtml::encode($data->reservation_notes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('assistance_needed')); ?>:
	<?php echo GxHtml::encode($data->assistance_needed); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('delivery_and_setup')); ?>:
	<?php echo GxHtml::encode($data->delivery_and_setup); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('takedown_needed')); ?>:
	<?php echo GxHtml::encode($data->takedown_needed); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('building_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->building)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('location_description')); ?>:
	<?php echo GxHtml::encode($data->location_description); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('reservation_status_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->reservationStatus)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('closure_notes')); ?>:
	<?php echo GxHtml::encode($data->closure_notes); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('end_date')); ?>:
	<?php echo GxHtml::encode($data->end_date); ?>
	<br />
	*/ ?>

</div>
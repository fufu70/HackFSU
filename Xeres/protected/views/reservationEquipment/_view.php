<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('item_number')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->item_number), array('view', 'id' => $data->item_number)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('reservation_number')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->reservationNumber)); ?>
	<br />

</div>
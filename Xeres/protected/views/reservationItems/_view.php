<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('reservation_number')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->reservation_number), array('view', 'id' => $data->reservation_number)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('item_number')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->itemNumber)); ?>
	<br />

</div>
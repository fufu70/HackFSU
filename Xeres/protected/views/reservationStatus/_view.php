<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('reservation_status_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->reservation_status_id), array('view', 'id' => $data->reservation_status_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />

</div>
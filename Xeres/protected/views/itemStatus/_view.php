<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('status_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->status_id), array('view', 'id' => $data->status_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('status')); ?>:
	<?php echo GxHtml::encode($data->status); ?>
	<br />

</div>
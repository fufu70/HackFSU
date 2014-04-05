<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('item_type_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->item_type_id), array('view', 'id' => $data->item_type_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('type')); ?>:
	<?php echo GxHtml::encode($data->type); ?>
	<br />

</div>
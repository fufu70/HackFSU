<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('building_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->building_id), array('view', 'id' => $data->building_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('building_name')); ?>:
	<?php echo GxHtml::encode($data->building_name); ?>
	<br />

</div>
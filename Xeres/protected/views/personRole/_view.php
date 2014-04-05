<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('role_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->role_id), array('view', 'id' => $data->role_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('role')); ?>:
	<?php echo GxHtml::encode($data->role); ?>
	<br />

</div>
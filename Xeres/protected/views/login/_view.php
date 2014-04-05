<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('people_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->people_id), array('view', 'id' => $data->people_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('password')); ?>:
	<?php echo GxHtml::encode($data->password); ?>
	<br />

</div>
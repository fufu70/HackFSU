<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('people_id')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->people_id), array('view', 'id' => $data->people_id)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('email_address')); ?>:
	<?php echo GxHtml::encode($data->email_address); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('last_name')); ?>:
	<?php echo GxHtml::encode($data->last_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('first_name')); ?>:
	<?php echo GxHtml::encode($data->first_name); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('campus_phone')); ?>:
	<?php echo GxHtml::encode($data->campus_phone); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('cell_phone')); ?>:
	<?php echo GxHtml::encode($data->cell_phone); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('role_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->role)); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('student_id')); ?>:
	<?php echo GxHtml::encode($data->student_id); ?>
	<br />
	*/ ?>

</div>
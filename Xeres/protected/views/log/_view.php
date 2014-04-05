<?php
/* @var $this LogController */
/* @var $data Log */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->log_id), array('view', 'id'=>$data->log_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('people_number')); ?>:</b>
	<?php echo CHtml::encode($data->people_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('object_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->object_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('object_number')); ?>:</b>
	<?php echo CHtml::encode($data->object_number); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_type_id')); ?>:</b>
	<?php echo CHtml::encode($data->log_type_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('previous_entry')); ?>:</b>
	<?php echo CHtml::encode($data->previous_entry); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('current_entry')); ?>:</b>
	<?php echo CHtml::encode($data->current_entry); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('log_time')); ?>:</b>
	<?php echo CHtml::encode($data->log_time); ?>
	<br />

	*/ ?>

</div>
<?php
/* @var $this LogTypeController */
/* @var $data LogType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->log_type_id), array('view', 'id'=>$data->log_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('log_type')); ?>:</b>
	<?php echo CHtml::encode($data->log_type); ?>
	<br />


</div>
<?php
/* @var $this ObjectTypeController */
/* @var $data ObjectType */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('object_type_id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->object_type_id), array('view', 'id'=>$data->object_type_id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('object_type')); ?>:</b>
	<?php echo CHtml::encode($data->object_type); ?>
	<br />


</div>
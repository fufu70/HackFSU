<div class="view">

	<?php echo GxHtml::encode($data->getAttributeLabel('item_number')); ?>:
	<?php echo GxHtml::link(GxHtml::encode($data->item_number), array('view', 'id' => $data->item_number)); ?>
	<br />

	<?php echo GxHtml::encode($data->getAttributeLabel('su_number')); ?>:
	<?php echo GxHtml::encode($data->su_number); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('manufacturer')); ?>:
	<?php echo GxHtml::encode($data->manufacturer); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('model')); ?>:
	<?php echo GxHtml::encode($data->model); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('accession_date')); ?>:
	<?php echo GxHtml::encode($data->accession_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('de_accession_date')); ?>:
	<?php echo GxHtml::encode($data->de_accession_date); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('status_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->status)); ?>
	<br />
	<?php /*
	<?php echo GxHtml::encode($data->getAttributeLabel('item_type_id')); ?>:
		<?php echo GxHtml::encode(GxHtml::valueEx($data->itemType)); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('serial_number')); ?>:
	<?php echo GxHtml::encode($data->serial_number); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('barcode_number')); ?>:
	<?php echo GxHtml::encode($data->barcode_number); ?>
	<br />
	<?php echo GxHtml::encode($data->getAttributeLabel('description')); ?>:
	<?php echo GxHtml::encode($data->description); ?>
	<br />
	*/ ?>

</div>
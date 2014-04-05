<div class="form">


<?php $form = $this->beginWidget('GxActiveForm', array(
	'id' => 'people-form',
	'enableAjaxValidation' => false,
));
?>

	<p class="note">
		<?php echo Yii::t('app', 'Fields with'); ?> <span class="required">*</span> <?php echo Yii::t('app', 'are required'); ?>.
	</p>

	<?php echo $form->errorSummary($model); ?>

		<div class="row">
		<?php echo $form->labelEx($model,'email_address'); ?>
		<?php echo $form->textField($model, 'email_address', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'email_address'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'last_name'); ?>
		<?php echo $form->textField($model, 'last_name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'last_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'first_name'); ?>
		<?php echo $form->textField($model, 'first_name', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'first_name'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'campus_phone'); ?>
		<?php echo $form->textField($model, 'campus_phone', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'campus_phone'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'cell_phone'); ?>
		<?php echo $form->textField($model, 'cell_phone', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'cell_phone'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'role_id'); ?>
		<?php echo $form->dropDownList($model, 'role_id', GxHtml::listDataEx(PersonRole::model()->findAllAttributes(null, true))); ?>
		<?php echo $form->error($model,'role_id'); ?>
		</div><!-- row -->
		<div class="row">
		<?php echo $form->labelEx($model,'student_id'); ?>
		<?php echo $form->textField($model, 'student_id', array('maxlength' => 45)); ?>
		<?php echo $form->error($model,'student_id'); ?>
		</div><!-- row -->

		<label><?php echo GxHtml::encode($model->getRelationLabel('logs')); ?></label>
		<?php echo $form->checkBoxList($model, 'logs', GxHtml::encodeEx(GxHtml::listDataEx(Log::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('reservations')); ?></label>
		<?php echo $form->checkBoxList($model, 'reservations', GxHtml::encodeEx(GxHtml::listDataEx(Reservation::model()->findAllAttributes(null, true)), false, true)); ?>
		<label><?php echo GxHtml::encode($model->getRelationLabel('reservations1')); ?></label>
		<?php echo $form->checkBoxList($model, 'reservations1', GxHtml::encodeEx(GxHtml::listDataEx(Reservation::model()->findAllAttributes(null, true)), false, true)); ?>

<?php
echo GxHtml::submitButton(Yii::t('app', 'Save'));
$this->endWidget();
?>
</div><!-- form -->
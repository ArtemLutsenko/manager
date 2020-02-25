<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'order-items-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>



	<div class="row">
		<?php echo $form->labelEx($model,'product_id'); ?>
		<?php echo $form->textField($model->product,'product_name',array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'product_id'); ?>
	</div>


    <div class="row">
        <?php echo $form->labelEx($model,'length'); ?>
        <?php echo $form->textField($model,'length'); ?>
        <?php echo $form->error($model,'length'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'insert'); ?>
		<?php echo $form->textField($model,'insert'); ?>
		<?php echo $form->error($model,'insert'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'width'); ?>
        <?php echo $form->textField($model,'width'); ?>
        <?php echo $form->error($model,'width'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'height'); ?>
		<?php echo $form->textField($model,'height'); ?>
		<?php echo $form->error($model,'height'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'quantity'); ?>
		<?php echo $form->textField($model,'quantity'); ?>
		<?php echo $form->error($model,'quantity'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'subtotal'); ?>
		<?php echo $form->textField($model,'subtotal'); ?>
		<?php echo $form->error($model,'subtotal'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>2, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
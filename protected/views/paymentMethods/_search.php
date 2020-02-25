<?php
/* @var $this PaymentMethodsController */
/* @var $model PaymentMethods */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'payment_method_id'); ?>
		<?php echo $form->textField($model,'payment_method_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'payment_method_name'); ?>
		<?php echo $form->textField($model,'payment_method_name',array('size'=>60,'maxlength'=>100)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
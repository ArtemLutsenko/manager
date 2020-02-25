<?php
/* @var $this PropertiesController */
/* @var $model Properties */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'property_id'); ?>
		<?php echo $form->textField($model,'property_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attribute_id'); ?>
		<?php echo $form->textField($model,'attribute_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_info_id'); ?>
		<?php echo $form->textField($model,'property_info_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'img_url'); ?>
		<?php echo $form->textField($model,'img_url',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'img_url_thumb'); ?>
		<?php echo $form->textField($model,'img_url_thumb',array('size'=>60,'maxlength'=>255)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
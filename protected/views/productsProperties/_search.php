<?php
/* @var $this ProductsPropertiesController */
/* @var $model ProductsProperties */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'product_property_id'); ?>
		<?php echo $form->textField($model,'product_property_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_group_id'); ?>
		<?php echo $form->textField($model,'price_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'property_id'); ?>
		<?php echo $form->textField($model,'property_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'add_payment'); ?>
		<?php echo $form->textField($model,'add_payment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
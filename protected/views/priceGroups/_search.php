<?php
/* @var $this PriceGroupsController */
/* @var $model PriceGroups */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'price_group_id'); ?>
		<?php echo $form->textField($model,'price_group_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price_group_name'); ?>
		<?php echo $form->textField($model,'price_group_name',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
<?php
/* @var $this TabletopController */
/* @var $model Tabletop */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'tabletop_id'); ?>
		<?php echo $form->textField($model,'tabletop_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'attribute_id'); ?>
		<?php echo $form->textField($model,'attribute_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'add'); ?>
		<?php echo $form->textField($model,'add'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
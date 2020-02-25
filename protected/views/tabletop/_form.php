<?php
/* @var $this TabletopController */
/* @var $model Tabletop */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tabletop-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'attribute_id'); ?>
        <?php
        $models =  Attributes::model()->findAll(array('order' => 'name'));
        $list = CHtml::listData($models, 'attribute_id', 'name');
        echo CHtml::dropDownList('Tabletop[attribute_id]', $category, $list,
            array(
                'empty' => 'Виберіть атрибут товару',
                'id'=>'TabletopAttributes_attribute_id',
                'options'=>array($model->attribute->attribute_id=>array('selected'=>'selected')),
            )
        );
        ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'add'); ?>
		<?php echo $form->textField($model,'add'); ?>
		<?php echo $form->error($model,'add'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
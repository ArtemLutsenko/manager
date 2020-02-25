<?php
/* @var $this ProductsController */
/* @var $model Products */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'product_name'); ?>
		<?php echo $form->textField($model,'product_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'product_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_length'); ?>
		<?php echo $form->textField($model,'product_length',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'product_length'); ?>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'product_insert'); ?>
		<?php echo $form->textField($model,'product_insert',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'product_insert'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_width'); ?>
		<?php echo $form->textField($model,'product_width',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'product_width'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'product_height'); ?>
		<?php echo $form->textField($model,'product_height',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'product_height'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'tabletop_id'); ?>
        <?php

        $models = Tabletop::model()->findAll(array('order' => 'tabletop_id'));
        $list = CHtml::listData($models, 'tabletop_id', 'attribute.name');
        echo CHtml::dropDownList('Products[tabletop_id]', $category, $list,
            array(
                'empty' => 'Виберіть тип повехні',
                'id'=>'Products_tabletop_id',
                'options'=>array($model->tabletop_id=>array('selected'=>'selected')),
            )
        );
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'product_type_id'); ?>
        <?php

        $models = ProductsTypes::model()->findAll(array('order' => 'product_type_id'));
        $list = CHtml::listData($models, 'product_type_id', 'name');
        echo CHtml::dropDownList('Products[product_type_id]', $category, $list,
            array(
                'empty' => 'Виберіть тип товару',
                'id'=>'Products_product_type_id',
                'options'=>array($model->product_type_id=>array('selected'=>'selected')),
            )
        );
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'patina'); ?>
        <div class="compactRadioGroup">
        <?php   echo $form->radioButtonList($model, 'patina',
            array(  0 => 'Ні',
                1 => 'Так' ) );
        ?>
        </div>
        <?php echo $form->error($model,'patina'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
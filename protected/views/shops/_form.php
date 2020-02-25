<?php
/* @var $this ShopsController */
/* @var $model Shops */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'shops-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'full_name'); ?>
		<?php echo $form->textField($model,'full_name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'full_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'price_group_id'); ?>
        <?php
        $models = PriceGroups::model()->findAll(array('order' => 'price_group_name'));
        $list = CHtml::listData($models, 'price_group_id', 'price_group_name');
        echo CHtml::dropDownList('Shops[price_group_id]', $category, $list,
            array(
                'empty' => 'Виберіть цінову категорію',
                'id'=>'ProductsPrices_price_group_id',
                'options'=>array($model->priceGroup->price_group_id=>array('selected'=>'selected')),
            )
        ); ?>
        <?php echo $form->error($model,'price_group_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'city_id'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
            'name'=>'city_id',
            'value' => $model->city->city_name,
            'source'=>Yii::app()->createUrl('ajax/autocomplete'),

            'options'=>array(
                'select' => "js:function(event, ui) {
                                $('#hidden').val(ui.item.id);
                            }",
                'change' => "js:function(event, ui) {
                            if (!ui.item) {
                                 $('#hidden').val('');
                                }
                            }",
            ),
            'htmlOptions'=>array(
                //'name'=>'OrderCustomers[city_id]',
                'id'=>'Shops_city_id',
                'type'=>'text',
            ),
        ));
        ?>
        <input name="Shops[city_id]" id="hidden" type="hidden" maxlength="255" value="<?php echo  $model->city->city_id;?>" />
        <?php echo $form->error($model,'city_id'); ?>
    </div>

    <div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'phone'); ?>
        <?php echo $form->textArea($model,'phone',array('rows'=>2, 'cols'=>30)); ?>
        <?php echo $form->error($model,'phone'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'debt'); ?>
		<?php //echo $form->textField($model,'debt',array('size'=>60,'maxlength'=>255)); ?>
		<?php //echo $form->error($model,'debt'); ?>
	</div>

	<div class="row">
		<?php //echo $form->labelEx($model,'comment'); ?>
		<?php //echo $form->textArea($model,'comment',array('rows'=>2, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'comment'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
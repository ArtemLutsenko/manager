<?php
/* @var $this OrdersItemsPropertiesController */
/* @var $model OrdersItemsProperties */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-items-properties-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
        'enableAjaxValidation' => false,

)); ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'order_item_id'); ?>
		<?php echo $form->textField($model->orderItem->product,'product_name',array('readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'order_item_id'); ?>
	</div>

    <div class="row">
        <?php echo $model->property->attribute->name; ?>
        <input name="Properties[attribute_id]" id="ProductsProperties_attribute_id" type="hidden" maxlength="255" value="<?php echo  $model->property->attribute_id;?>" />
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'property_id'); ?>
		<?php //echo $form->textField($model,'property_id'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
            'name'=>'property_id',
            'value' => $model->property->name,
            'source'=>'js: function(request, response) {
                       $.ajax({
                           url: "'.Yii::app()->createUrl('properties/orderItemPropertyUpdate').'",
                           dataType: "json",
                           data: {
                               term: request.term,
                               att: $("#ProductsProperties_attribute_id").val()
                           },
                           success: function (data) {
                                   response(data);
                           }
                       })
                        }',
            'options'=>array(
                'select' => "js:function(event, ui) {
                                    $('#hidden').val(ui.item.id);
                                    $('#OrdersItemsProperties_add_payment').val(ui.item.add);
                                }",
                'change' => "js:function(event, ui) {
                                if (!ui.item) {
                                     $('#hidden').val('');
                                    }
                                }",
            ),
            'htmlOptions'=>array(
                'id'=>'OrdersItemsProperties_property_id',
                'type'=>'text',
            ),
        ));
        ?>
        <input name="OrdersItemsProperties[property_id]" id="hidden" type="hidden" maxlength="255" value="<?php echo  $model->property_id;?>" />
		<?php echo $form->error($model,'property_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<?php
/* @var $this ProductsPropertiesController */
/* @var $model ProductsProperties */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-properties-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
));


    ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'price_group_id'); ?>
        <?php
        $models = PriceGroups::model()->findAll(array('order' => 'price_group_name'));
        $list = CHtml::listData($models, 'price_group_id', 'price_group_name');
        echo CHtml::dropDownList('ProductsProperties[price_group_id]', $category, $list,
            array(
                'empty' => 'Виберіть цінову категорію',
                'id'=>'ProductsProperties_price_group_id',
                'options'=>array($model->priceGroup->price_group_id=>array('selected'=>'selected')),
            )
        );
        ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'property_id'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
            'name'=>'property_id',
            'value' => $model->property->name,//properties/autocomplete
            'source'=>'js: function(request, response) {
                       $.ajax({
                           url: "'.Yii::app()->createUrl('properties/propertySuggest').'",
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
                                $('#prop').val(ui.item.id);
                            }",
                'change' => "js:function(event, ui) {
                            if (!ui.item) {
                                 $('#prop').val('');
                                }
                            }",
            ),
            'htmlOptions'=>array(
                'id'=>'ProductsProperties_property_id',
                'type'=>'text',
            ),
        ));
        ?>
        <input name="ProductsProperties[property_id]" id="prop" type="hidden" maxlength="255" value="<?php echo  $model->property->property_id;?>" />
        <?php echo $form->error($model,'property_id'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_payment'); ?>
		<?php echo $form->textField($model,'add_payment'); ?>
		<?php echo $form->error($model,'add_payment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
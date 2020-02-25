<?php
/* @var $this ProductsAttributesController */
/* @var $model ProductsAttributes */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'products-attributes-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'product_id'); ?>
        <?php
        $this->widget('zii.widgets.jui.CJuiAutoComplete',array(
            'name'=>'product_id',
            'value' => $model->product->product_name,
            'source'=>Yii::app()->createUrl('products/autocomplete'),
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
                'id'=>'ProductsAttributes_product_id',
                'type'=>'text',
            ),
        ));
        ?>
        <input name="ProductsAttributes[product_id]" id="hidden" type="hidden" maxlength="255" value="<?php echo  $model->product->product_id;?>" />
        <?php echo $form->error($model,'product_id'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'attribute_id'); ?>
        <?php
        $models =  Attributes::model()->findAll(array('order' => 'name'));
        $list = CHtml::listData($models, 'attribute_id', 'name');
        echo CHtml::dropDownList('ProductsAttributes[attribute_id]', $category, $list,
            array(
                'empty' => 'Виберіть атрибут товару',
                'id'=>'ProductsAttributes_attribute_id',
                'options'=>array($model->attribute->attribute_id=>array('selected'=>'selected')),
            )
        );
        ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
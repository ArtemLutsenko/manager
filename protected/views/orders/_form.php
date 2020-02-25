<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'orders-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

    <p class="note">Поля, відмічені <span class="required">*</span> обов'язкові для заповнення.</p>

	<?php echo $form->errorSummary($model); ?>

    <?php if ($model->shop_id){?>

	<div class="row">
		<?php echo $form->labelEx($model,'shop_id'); ?>
		<?php echo $form->textField($model->shop,'full_name',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'shop_id'); ?>
	</div>

    <?php }else{ ?>

	<div class="row">
		<?php echo $form->labelEx($model,'customer_id'); ?>
		<?php echo $form->textField($model->customers,'last_name',array('size'=>10,'maxlength'=>10, 'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'customer_id'); ?>
	</div>

    <?php } ?>

    <div class="row">
		<?php echo $form->labelEx($model,'payment_name_id'); ?>
        <?php
        $pm = CHtml::listData(PaymentMethods::model()->findAll(),'payment_method_id', 'payment_method_name');
        echo $form->dropDownList($model,'payment_name_id',$pm,
            array(
                'empty' => 'Виберіть спосіб оплати',
                )
            );
        ?>
		<?php echo $form->error($model,'payment_name_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'shipment_name_id'); ?>
        <?php
        $sm = CHtml::listData(ShipmentMethods::model()->findAll(),'shipment_name_id', 'shipment_name');
        echo $form->dropDownList($model,'shipment_name_id',$sm,
            array(
                'empty' => 'Виберіть спосіб оплати',
            )
        );
        ?>
		<?php echo $form->error($model,'shipment_name_id'); ?>
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
                'id'=>'Orders_city_id',
                'type'=>'text',
            ),
        ));
        ?>
        <input name="Orders[city_id]" id="hidden" type="hidden" maxlength="255" value="<?php echo  $model->city->city_id;?>" />
		<?php echo $form->error($model,'city_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order_total'); ?>
		<?php echo $form->textField($model,'order_total',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'order_total'); ?>
	</div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'created_on'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'created_on',
                'model' => $model,
                'attribute' => 'created_on',
                'language' => 'ru',
                'value' => $model->created_on,
                'options' => array(
                    'showAnim' => 'clip',
                    'showButtonPanel'=>true,
                    'dateFormat'=>'dd-mm-yy',
                    ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));?>
        <?php echo $form->error($model,'delivery_date'); ?>
	</div>


	<div class="row">
        <?php echo $form->labelEx($model,'delivery_date'); ?>
        <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                'name' => 'delivery_date',
                'model' => $model,
                'attribute' => 'delivery_date',
                'language' => 'ru',
                'value' => $model->delivery_date,
                'options' => array(
                    'showAnim' => 'clip',
                    'showButtonPanel'=>true,
                    'minDate'=> 0,
                    'dateFormat'=>'dd-mm-yy',
                    ),
            'htmlOptions' => array(
                'style' => 'height:20px;'
            ),
        ));?>
        <?php echo $form->error($model,'delivery_date'); ?>
	</div>

    <div class="row">
        <?php echo $form->labelEx($model,'paid'); ?>
        <div class="compactRadioGroup">
            <?php   echo $form->radioButtonList($model, 'paid',
                array(  0 => 'Ні',
                    1 => 'Так' ) );
            ?>
        </div>
        <?php echo $form->error($model,'paid'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Додати' : 'Зберегти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
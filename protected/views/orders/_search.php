<?php
/* @var $this OrdersController */
/* @var $model Orders */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<p>Дата доставки</p>
    <?php
    // Date range search inputs
    $attribute = 'delivery_date';
    for ($i = 0; $i <= 1; $i++)
    {
        echo ($i == 0 ? Yii::t('main', '<p>Від: ') : Yii::t('main', '<p>До: '));
        $this->widget('zii.widgets.jui.CJuiDatePicker', array(
            'id'=>CHtml::activeId($model, $attribute.'_'.$i),
            'model'=>$model,
            'language' => 'uk',
            'attribute'=>$attribute."[$i]",
            'options'=>array(
                'showOn' => 'focus',
                'showAnim'=>'fold',
                'dateFormat'=>'yy-mm-dd',
                'showOtherMonths' => true,
                'selectOtherMonths' => true,
                'changeMonth' => true,
                'changeYear' => true,
                'showButtonPanel' => true,
            ),
        ));
    }
    ?>

    <div class="row">
        <?php echo $form->label($model,'city_or_region'); ?>
        <?php echo $form->textField($model,'city_search'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'customer_search'); ?>
        <?php echo $form->textField($model,'customer_search'); ?>
    </div>

    <div class="row">
        <?php echo $form->label($model,'shop_id'); ?>
        <?php $st = CHtml::listData(Shops::model()->findAll(array('order'=>'full_name ASC')),'shop_id', 'full_name');
        echo $form->dropDownList($model, 'shop_id', $st,
            array(
                'empty' => 'Виберіть магазин',
            ));?>
    </div>

        <div class="row buttons">
		<?php echo CHtml::submitButton('Пошук'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
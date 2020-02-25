<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

$this->breadcrumbs=array(
	'Замовлені товари'=>array('admin'),
	'Архів замовлених товарів',
);



Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['uk'],{'dateFormat':'yy-mm-dd'}));
}


");


Yii::app()->clientScript->registerScript('search', "

$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#order-items-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Архів замовленних товарів</h1>


<?php //echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
)); ?>

    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'order-items-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
        'columns'=>array(
            //'order_item_id',
            array(
                'name'=>'order_id',
                'type'=>'raw',
                'value'=>'CHtml::link($data->order_id, Yii::app()->createUrl("orders/view/",array("id"=>$data->order_id)))',
                'headerHtmlOptions'=>array(
                    'width'=>'40px',
                ),
            ),
            array(
                'name'=>'product_id',
                'type'=>'raw',
                'value'=>'$data->product->product_name',
                'headerHtmlOptions'=>array(
                    'width'=>'150px',
                ),
            ),
            array(
                'name'=>'length',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'insert',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'width',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'height',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'quantity',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'37px',
                ),
            ),
            array(
                'name'=>'comment',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'200px',
                ),
            ),
            array(
                'header'=>'Колір',
                'value'=>'$data->getColor($data->order_item_id)',
                'headerHtmlOptions'=>array(
                    'width'=>'300px',
                ),
            ),
            array(
                'class'=>'DToggleColumn',
                'name'=>'archive',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'),
                'htmlOptions'=>array('width'=>'20px'),

            ),
            /*'price',
            'subtotal',
            */
            array(
                'name'=>'created_by',
                'type'=>'raw',
                'value'=>'$data->creator->username',
            ),
            array(
                'name' => 'created_on',
                'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                        'model'=>$model,
                        'attribute'=>'created_on',
                        'language' => 'uk',
                        'htmlOptions' => array(
                            'id' => 'datepicker_for_due_date',
                            'size' => '10',
                        ),
                        'options' => array(
                            'showOn' => 'focus',
                            'dateFormat' => 'yy-mm-dd',
                            'showOtherMonths' => true,
                            'selectOtherMonths' => true,
                            'changeMonth' => true,
                            'changeYear' => true,
                            'showButtonPanel' => true,
                        )
                    ),
                    true),
                'headerHtmlOptions'=>array(
                    'width'=>'86px',
                ),
            ),
            array(
                'name'=>'modified_by',
                'type'=>'raw',
                'value'=>'$data->updater->username',
            ),
            array(
                'name'=>'modified_on',
                'type'=>'raw',
                'headerHtmlOptions'=>array(
                    'width'=>'86px',
                ),
            ),
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    )); ?>
<?php $this->endWidget(); ?>


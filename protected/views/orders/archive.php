<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Замовлення'=>array('admin'),
	'Архів замовлень',
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
	$('#orders-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Архів замовлень</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'orders-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
	'filter'=>$model,
	'columns'=>array(

        array(
            'name'=>'order_id',
            'value'=>'CHtml::link($data->order_id, Yii::app()->createUrl("orders/view/",array("id"=>$data->primaryKey)))',
            'type'  => 'raw',
        ),
        array(
            'name'=>'shop_id',
            'type'=>'raw',
            'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'shop_id', 'full_name'),
            //'value'=>'$data->shop->full_name',
            'value'=>'CHtml::link($data->shop->full_name, Yii::app()->createUrl("shops/archiveView/",array("id"=>$data->shop_id)))',
        ),
        array(
            'name'=>'customer_search',
            'type'=>'raw',
            'value'=>'$data->getCustomerArchiveLink($data->customer_id)',
        ),
        array(
            'name'=>'city_search',
            'type'=>'raw',
            'value'=>'$data->city->city_name',
        ),
        array('name' => 'delivery_date',
            'value' => '$data->delivery_date!==null ? Yii::app()->dateFormatter->format("dd-MM-y", $data->delivery_date) : ""',
           'filter' => false,
        ),
        array(
            'name'  => 'order_total',
            'type'  => 'raw',
            'filter' => false,
        ),
        array(
            'class'=>'DToggleColumn',
            'name'=>'paid',
            'confirmation'=>'Змінити статус?',
            'filter'=>array(1=>'Так', 0=>'Ні'),
            'titles'=>array(1=>'Так', 0=>'Ні'),
            'htmlOptions'=>array('width'=>'20px'),
        ),
        array(
            'class'=>'DToggleColumn',
            'name'=>'archive',
            'confirmation'=>'Змінити статус?',
            'filter'=>array(1=>'Так', 0=>'Ні'),
            'titles'=>array(1=>'Так', 0=>'Ні'),
            'htmlOptions'=>array('width'=>'20px'),

        ),
        array('name' => 'created_on',
            'value' => '$data->created_on',
            'filter' => $this->widget('zii.widgets.jui.CJuiDatePicker', array(
                    'model'=>$model,
                    'attribute'=>'created_on',
                    'language' => 'uk',
                    'htmlOptions' => array(
                        'id' => 'datepicker_for_due_date',
                        'size' => '10',
                    ),
                    'options' => array(  // (#3)
                        'showOn' => 'focus',
                        'dateFormat' => 'yy-mm-dd',
                        'showOtherMonths' => true,
                        'selectOtherMonths' => true,
                        'changeMonth' => true,
                        'changeYear' => true,
                        'showButtonPanel' => true,
                    )
                ),
                true), // (#4)
        ),
        array(
            'name'=>'created_by',
            'type'=>'raw',
            'value'=>'$data->creator->username',
        ),

        'modified_on',
        array(
            'name'=>'modified_by',
            'type'=>'raw',
            'value'=>'$data->updater->username',
        ),
         /*'comment',
        'order_number',



        */
        array(
            'class'=>'CButtonColumn',
        ),
    ),
));

?>

<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Замовлення'=>array('index'),
	'Управління замовленнями',
);

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['uk'],{'dateFormat':'yy-mm-dd'}));
paintOrder()
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


function paintOrder(){
var d = new Date();
$('td.date').each(function(){
    var get = $(this).text()
    var res = (new Date(d).getTime() - new Date(get).getTime())/1000/60/60/24
    if (res < 8 ){
        $(this).addClass('green')
    }else if(res >=8 && res <=10){
        $(this).addClass('yellow')
    }else if(res>10) {
       $(this).addClass('red')
    }
    console.log(res);
})
}
paintOrder();


");


?>

<h1>Управління замовленнями</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button bt btn-2')); ?>

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
            'value'=>'CHtml::link($data->shop->full_name, Yii::app()->createUrl("shops/view/",array("id"=>$data->shop_id)))',
        ),
        array(
            'name'=>'customer_search',
            'type'=>'raw',
            'value'=>'$data->getCustomerLink($data->customer_id)',
        ),
        array(
            'name'=>'payment_name_id',
            'type'=>'raw',
            'filter' => CHtml::listData(PaymentMethods::model()->findAll(), 'payment_method_id', 'payment_method_name'),
            'value'=>'$data->paymentMethod->payment_method_name',
        ),
        array(
            'name'=>'shipment_name_id',
            'type'=>'raw',
            'filter' => CHtml::listData(ShipmentMethods::model()->findAll(), 'shipment_name_id', 'shipment_name'),
            'value'=>'$data->shipmentMethod->shipment_name',
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
        array('name' => 'created_on',
            'value' => '$data->created_on',
            'filter' => false, // (#4)
            'htmlOptions' => array('class' => 'date'),
            'headerHtmlOptions'=>array(
                'width'=>'67px',
            ),
        ),
        //////////////
        /*
         *
         * array(
            'name'  => 'status_id',
            'type'  => 'raw',
            'filter' => CHtml::listData(Status::model()->findAll(array('order' => 'status_id  ASC')), 'status_id', 'status_name'),
            'value'=>'Status::getOrderStatus($data->order_id, $data->status_id,  Yii::app()->controller->id )',
        ),
         array('header' => 'Накладна',
            'type'  => 'raw',
            'value' => 'CHtml::link("Друкувати", Yii::app()->createUrl("orders/print/",array("id"=>$data->primaryKey)), array("rel"=>"fancybox"))',
        ),
        */
        ///////////
        array(
            'class'=>'DToggleColumn',
            'name'=>'paid',
            'confirmation'=>'Змінити статус?',
            'filter'=>array(1=>'Оплачено', 0=>'Не оплачено'),
            'titles'=>array(1=>'Оплачено', 0=>'Не оплачено'),
            'htmlOptions'=>array('width'=>'20px'),
        ),
         /*'comment',
        'order_number',
        'created_by',
        'modified_on',
        'modified_by',
        */
        array(
            'class'=>'CButtonColumn',
        ),
    ),

));

?>

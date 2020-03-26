<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

$this->breadcrumbs=array(

	'Замовлені товари',
);

Yii::app()->clientScript->registerScript('re-install-date-picker', "
function reinstallDatePicker(id, data) {
    $('#datepicker_for_due_date').datepicker(jQuery.extend({showMonthAfterYear:false},jQuery.datepicker.regional['uk'],{'dateFormat':'yy-mm-dd'}));
paintOrder();
disableButton();

$('#hiden').parent().hide()
}
");


Yii::app()->clientScript->registerScript('search', "
function disableButton(){
$('a#printButton').addClass('disable-button');
$(':input:checkbox').on('click', function(){
var len = $(':checkbox:checked').length
    if(len > 0){
        $('a#printButton').removeClass('disable-button');
    }else{
       $('a#printButton').addClass('disable-button');
    }
})
}

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


function paintOrder(){
var d = new Date();
$('[data-created]').each(function(){

    var get = $(this).data('created')
    var res = (new Date(d).getTime() - new Date(get).getTime())/1000/60/60/24
    if (res < 8 ){
        $(this).find('.date').addClass('green')
    }else if(res >=8 && res <=10){
        $(this).find('.date').addClass('yellow')
    }else if(res>10) {
       $(this).find('.date').addClass('red')
    }
})
}
paintOrder();
disableButton();

$('#hiden').parent().hide()
");
?>

<h1>Замовленні товари</h1>

<?php echo CHtml::link('Розширений пошук','#',array('class'=>'search-button ')); ?>

<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div>


<?php $form=$this->beginWidget('CActiveForm', array(
    'enableAjaxValidation'=>true,
    'method'=>'Post',
)); ?>


<?php
$url = array('orderItems/printOrderItems');
echo CHtml::link(
    '<i class="fa fa-print feature-icon"></i> Друкувати обране',
    $url,
    array(
        'submit' => $url,
        'id'=>'printButton',
        'class'=>'bt btn-2',
    )
);

?>


    <?php $this->widget('zii.widgets.grid.CGridView', array(
        'id'=>'order-items-grid',
        'dataProvider'=>$model->search(),
        'filter'=>$model,
        'afterAjaxUpdate' => 'reinstallDatePicker', // (#1)
        'rowHtmlOptionsExpression' => 'array("data-created"=>$data->created_on)',
        'columns'=>array(
            array(
                'name'=>'order_item_id',
                'type'=>'raw',
              //  'headerHtmlOptions' => array('style' => 'display:none'),
              //  'htmlOptions' => array('style' => 'display:none'),
              //  'filter'=>CHtml::activeTextField($model, 'order_item_id', array('id'=>'hiden','style'=>'display:none')),
                //'filter'=>array('htmlOptions' => array('style' => 'display:none'),)
            ),
            array(
                'id'=>'autoId',
                'class'=>'CCheckBoxColumn',
                'selectableRows' => 50,
                'checkBoxHtmlOptions' => array('class' => 'classname'),
            ),
            array(
                'name'=>'order_id',
                'type'=>'raw',
                'value'=>'CHtml::link($data->order_id, Yii::app()->createUrl("orders/view/",array("id"=>$data->order_id)))',
                'headerHtmlOptions'=>array(
                    'width'=>'45px',
                ),
            ),
            array(
                'name' => 'created_on',
                'value' => 'Yii::app()->dateFormatter->format("dd-MM-y", $data->created_on)',
                'headerHtmlOptions'=>array(
                    'width'=>'65px',
                ),
                'filter' => false,
                'htmlOptions' => array('class' => 'date'),
            ),
            array(
                'name'=>'city_search',
                //'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'full_name', 'full_name'),
                'type'=>'raw',
                'value'=>'$data->order->city->city_name',
            ),
            array(
                'name'=>'shop_search',

                'filter' => CHtml::listData(Shops::model()->findAll(array('order' => 'full_name  ASC')), 'full_name', 'full_name'),///copy
                'type'=>'raw',
                'value'=>'$data->order->shop->full_name',
            ),
            array(
                'name'=>'customer_search',
                'type'=>'raw',
                'value'=>'Orders::model()->getCustomerName($data->order->customer_id)',
            ),
            array(
                'name'=>'product_id',
                'type'=>'raw',
                'value'=>'$data->product->product_name',
            ),
//            array(
//                'class'=>'DToggleColumn',
//                'name'=>'product_id',
//                'filter'=>array(2=>'Стілець', 1=>'Стіл', 0=>''),
//                'titles'=>array(2=>'Стілець', 1=>'Стіл', 0=>''),
//                'type'=>'raw',
//            ),
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
            'comment',
            array(
                'header'=>'Колір',
                'value'=>'$data->getColor($data->order_item_id)',
                'headerHtmlOptions'=>array(
                    'width'=>'175px',
                ),
            ),
            /*array(
                'name'  => 'status_id',
                'type'  => 'raw',
                'filter' => CHtml::listData(Status::model()->findAll(array('order' => 'status_id  ASC')), 'status_id', 'status_name'),
                'value'=>'Status::getOrderStatus($data->order_id, $data->status_id,  $getModel = Yii::app()->controller->id)',
                //'value'=>'$data->order_id',

            ),
            'price',
            'subtotal',
            'created_by',
            'modified_on',
            'modified_by',
            */
            array('header' => 'Дата доставки',
                'value' => '$data->order->delivery_date!==null ? Yii::app()->dateFormatter->format("dd-MM-y", $data->order->delivery_date) : ""',
                'filter' => false,
                'htmlOptions' => array('class' => 'delivery-date'),
            ),


            array(
                'class'=>'DToggleColumn',
                'name'=>'joiner',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'), 
				'htmlOptions'=>array('width'=>'20px'),
            ),
            array(
                'class'=>'DToggleColumn',
                'name'=>'primer',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'),
                'htmlOptions'=>array('width'=>'20px'),
            ),
            array(
                'class'=>'DToggleColumn',
                'name'=>'finish',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'),
                'htmlOptions'=>array('width'=>'20px'),
            ),
            array(
                'class'=>'DToggleColumn',
                'name'=>'coating',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'),
                'htmlOptions'=>array('width'=>'20px'),
            ),
            array(
                'class'=>'DToggleColumn',
                'name'=>'painter',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'), 
                'htmlOptions'=>array('width'=>'20px'),
            ),
            array(
                'class'=>'DToggleColumn',
                'name'=>'upholstery',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'), 
                'htmlOptions'=>array('width'=>'20px'),
				'visible'=>'!$data->isTable($data->order_item_id)',
            ),
			array(
                'class'=>'DToggleColumn',
                'name'=>'packing',
                'confirmation'=>'Змінити статус?',
                'filter'=>array(1=>'Так', 0=>'Ні'),
                'titles'=>array(1=>'Так', 0=>'Ні'), 
				'htmlOptions'=>array('width'=>'20px')
            ),
            array(
                'class'=>'CButtonColumn',
            ),
        ),
    )); ?>
<?php $this->endWidget(); ?>


<?php
/* @var $this OrdersController */
/* @var $model Orders */

$this->breadcrumbs=array(
	'Замовлення'=>array('admin'),
	$model->order_id,
);

$this->menu=array(
	array('label'=>'Оновити замовлення', 'url'=>array('update', 'id'=>$model->order_id)),
	array('label'=>'Видалити заомлення', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_id),'confirm'=>'Ви впевнені, що хочете видалити цей елемент?')),
	array('label'=>'Управління замовленнями', 'url'=>array('admin')),
);
?>

<h1>Замовлення №<?php echo $model->order_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_id',

        array(
            'name'=>'shop_id',
            'value'=>$model->shop->full_name,
            'visible'=>$model->shop_id == null ? false : true,
            //'type'=>'raw',
        ),
        array(
            'visible'=>$model->customer_id == null ? false : true,
            'name'=>'customer_id',
            //'value'=>$model->customers->first_name,
            'value'=>Customers::model()->getCustomerName($model->customer_id),
            //'value'=>'CHtml::link($data->order_id, Yii::app()->createUrl("orders/view/",array("id"=>$data->primaryKey)))',
            'type'=>'raw'
        ),
        array(
            'name'=>'payment_search',
            'value'=>$model->paymentMethod->payment_method_name,
        ),
        array(
            'name'=>'shipment_search',
            'value'=>$model->shipmentMethod->shipment_name,
        ),
        array(
            'name'=>'Область',
            'type'=>'raw',
            'value'=> $model->city->region_name,
        ),
        array(
            'name'=>'city_id',
            'type'=>'raw',
            'value'=> $model->city->city_name,
        ),
        'address',
        array(
            'name'=>'order_total',
            'value'=>$model->order_total." грн.",
        ),
        /*array(
            'name'=>'status_id',
            'type'=>'raw',
            'value'=> $model->status->status_name,
        ),
		'comment',*/
		'created_on',
		'creator.username',
		'modified_on',
		'updater.username',
		'delivery_date',

        array(
            'name'=>'paid',
            'value'=>$model->paid == 0 ? Ні : Так,
        ),
        array(
            'name'=>'archive',
            'value'=>$model->archive == 0 ? Ні : Так,
        ),
	),
)); ?>


<?php
if ( $model2 !== null )
{
    $this->widget('zii.widgets.grid.CGridView', array(
    'id'=>'order-items-grid',
    'dataProvider'=>$model2->search(),
    'template' => '{items} {pager}',//{summary}

    'columns'=>array(
        array(
            'name'=>'product_id',
            'type'=>'raw',
            'value'=>'$data->product->product_name',
            'headerHtmlOptions'=>array(
                'width'=>'120px',
            ),
        ),
        array(
            'name'=>'length',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'70px',
            ),
        ),
        array(
            'name'=>'insert',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'70px',
            ),
        ),
        array(
            'name'=>'width',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'70px',
            ),
        ),
        array(
            'name'=>'height',
            'type'=>'raw',
            'headerHtmlOptions'=>array(
                'width'=>'70px',
            ),
        ),
        'quantity',
        'price',
        'subtotal',

        array(
            'header'=>'Колір',
            'value'=>'$data->getColor($data->order_item_id)',
        ),
         'comment',
        array(
            //'class'=>'DToggleColumn',
            'name'=>'archive',
            'value'=>'$data->archive == 0 ? ні : так',
            'htmlOptions'=>array('width'=>'20px'),

        ),
        /*'created_on',
        'created_by',
        'modified_on',
        'modified_by',
        'status.status_name',
        */

        array(
            'class'=>'CButtonColumn',
            'template'=>'{update}{delete}',
            'buttons'=>array
            (
                'update' => array
                (
                    'url'=>'CController::createUrl("/orderItems/update", array("id"=>$data->primaryKey))'
                ),
                'delete' => array
                (
                    'url'=>'CController::createUrl("/orderItems/delete", array("id"=>$data->primaryKey))'
                ),
            ),
        ),
    ),
));
}
?>

<?php
/* @var $this OrderItemsController */
/* @var $model OrderItems */

$this->breadcrumbs=array(
	'Замовлені товри'=>array('admin'),
	$model->product->product_name,
);

$this->menu=array(


	array('label'=>'Редагувати товар', 'url'=>array('update', 'id'=>$model->order_item_id)),
	array('label'=>'Видалити товар', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_item_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Замовлені товри', 'url'=>array('admin')),
);
?>

<h1>Замовлений товар <?php echo $model->product->productType->name." ".$model->product->product_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		'order_id',
		'product.product_name',
		'width',
		'insert',
		'length',
		'height',
		'quantity',
		'price',
		'subtotal',
		'status.status_name',
		'comment',
		'created_on',
		//'created_by',
		'modified_on',
		//'modified_by',
	),
)); ?>

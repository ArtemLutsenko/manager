<?php
/* @var $this OrdersItemsPropertiesController */
/* @var $model OrdersItemsProperties */

$this->breadcrumbs=array(
	'Orders Items Properties'=>array('index'),
	$model->order_item_property_id,
);

$this->menu=array(
	array('label'=>'List OrdersItemsProperties', 'url'=>array('index')),
	array('label'=>'Create OrdersItemsProperties', 'url'=>array('create')),
	array('label'=>'Update OrdersItemsProperties', 'url'=>array('update', 'id'=>$model->order_item_property_id)),
	array('label'=>'Delete OrdersItemsProperties', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->order_item_property_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage OrdersItemsProperties', 'url'=>array('admin')),
);
?>

<h1>View OrdersItemsProperties #<?php echo $model->order_item_property_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'order_item_property_id',
		'order_item_id',
		'property_id',
		'add_payment',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
	),
)); ?>

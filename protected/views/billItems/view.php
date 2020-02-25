<?php
/* @var $this BillItemsController */
/* @var $model BillItems */

$this->breadcrumbs=array(
	'Bill Items'=>array('index'),
	$model->bill_item_id,
);

$this->menu=array(
	array('label'=>'List BillItems', 'url'=>array('index')),
	array('label'=>'Create BillItems', 'url'=>array('create')),
	array('label'=>'Update BillItems', 'url'=>array('update', 'id'=>$model->bill_item_id)),
	array('label'=>'Delete BillItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->bill_item_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage BillItems', 'url'=>array('admin')),
);
?>

<h1>View BillItems #<?php echo $model->bill_item_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'bill_item_id',
		'bill_id',
		'order_item_id',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
	),
)); ?>

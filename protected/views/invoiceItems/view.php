<?php
/* @var $this InvoiceItemsController */
/* @var $model InvoiceItems */

$this->breadcrumbs=array(
	'Invoice Items'=>array('index'),
	$model->invoice_item_id,
);

$this->menu=array(
	array('label'=>'List InvoiceItems', 'url'=>array('index')),
	array('label'=>'Create InvoiceItems', 'url'=>array('create')),
	array('label'=>'Update InvoiceItems', 'url'=>array('update', 'id'=>$model->invoice_item_id)),
	array('label'=>'Delete InvoiceItems', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->invoice_item_id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage InvoiceItems', 'url'=>array('admin')),
);
?>

<h1>View InvoiceItems #<?php echo $model->invoice_item_id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'invoice_item_id',
		'bill_id',
		'order_item_id',
		'created_on',
		'created_by',
		'modified_on',
		'modified_by',
	),
)); ?>

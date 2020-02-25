<?php
/* @var $this InvoiceItemsController */
/* @var $model InvoiceItems */

$this->breadcrumbs=array(
	'Invoice Items'=>array('index'),
	$model->invoice_item_id=>array('view','id'=>$model->invoice_item_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List InvoiceItems', 'url'=>array('index')),
	array('label'=>'Create InvoiceItems', 'url'=>array('create')),
	array('label'=>'View InvoiceItems', 'url'=>array('view', 'id'=>$model->invoice_item_id)),
	array('label'=>'Manage InvoiceItems', 'url'=>array('admin')),
);
?>

<h1>Update InvoiceItems <?php echo $model->invoice_item_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
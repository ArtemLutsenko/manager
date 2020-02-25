<?php
/* @var $this BillItemsController */
/* @var $model BillItems */

$this->breadcrumbs=array(
	'Bill Items'=>array('index'),
	$model->bill_item_id=>array('view','id'=>$model->bill_item_id),
	'Update',
);

$this->menu=array(
	array('label'=>'List BillItems', 'url'=>array('index')),
	array('label'=>'Create BillItems', 'url'=>array('create')),
	array('label'=>'View BillItems', 'url'=>array('view', 'id'=>$model->bill_item_id)),
	array('label'=>'Manage BillItems', 'url'=>array('admin')),
);
?>

<h1>Update BillItems <?php echo $model->bill_item_id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
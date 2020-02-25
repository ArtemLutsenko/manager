<?php
/* @var $this BillItemsController */
/* @var $model BillItems */

$this->breadcrumbs=array(
	'Bill Items'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List BillItems', 'url'=>array('index')),
	array('label'=>'Manage BillItems', 'url'=>array('admin')),
);
?>

<h1>Create BillItems</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>
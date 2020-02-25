<?php
/* @var $this BillController */
/* @var $model Bill */

$this->breadcrumbs=array(
	'Bills'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Bill', 'url'=>array('index')),
	array('label'=>'Manage Bill', 'url'=>array('admin')),
);
?>

<h1>Create Bill</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>